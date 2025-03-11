<?php

namespace App\Http\Controllers\Users;

use Throwable;
use App\Models\Izin;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Services\PresensiService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PersensiController extends Controller
{
    protected $presensi;
    public function __construct(PresensiService $presensiService)
    {
        $this->presensi = $presensiService;
    }

    public function index()
    {
        $data['title'] = 'Isi Presensi';
        $data['lat'] = Auth::user()->opd->lat;
        $data['long'] = Auth::user()->opd->long;
        return view('users.persensi.index', $data);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $presensi = $this->presensi->Query()
            ->where('user_id', $user->id)
            ->whereDate('created_at', Carbon::now()->toDateString())
            ->latest()
            ->first();

        //cek apakah user sedang cuti atau tidak
        $cuti = Izin::where('user_id', $user->id)->latest()->first();
        if ($cuti) {
            $tanggal_awal_cuti = Carbon::createFromDate($cuti->tanggal_awal);
            $tanggal_masuk_cuti = Carbon::createFromDate($cuti->tanggal_masuk);

            // Periksa apakah tanggal tersebut sudah lewat dari hari ini
            //
            // refactor: ubah menjadi "tanggal awal cuti sudah lewat
            // dan tanggal masuk cuti belum lewat" maka tidak dapat presensi
            if ($tanggal_awal_cuti->isPast() && !$tanggal_masuk_cuti->isPast()) {
                return $this->warning("Anda masih dalam masa cuti");
            }
        }

        if ($presensi) {
            //cek apakah sudah mengisi presensi pulang
            if (isset($presensi->jam_pulang)) {
                return $this->warning('Hari Ini Anda Sudah Mengisi Presensi 2X!');
            }

            //pastikan user mengisi presensi sore diantara jam 14 sampai jam 18
            $current_time = Carbon::now();
            $awal_jam_pulang_sore = Carbon::parse(env('JAM_AWAL_PULANG')); // Jam 14 pagi
            $akhir_jam_pulang_sore = Carbon::parse(env('JAM_AKHIR_PULANG')); // Jam 16 siang

            if (!$current_time->between($awal_jam_pulang_sore, $akhir_jam_pulang_sore)) {
                return $this->warning('Presensi sore dimulai dari jam 14.00 sampai jam 18.00 sore!');
            }

            try {
                $base64 = $request->base64;
                //menyimpan file ke storage
                $folderPath = "public/images/" . date('Y') . '/';
                $image_parts = explode(";base64,", $base64);
                $image_type_aux = explode("image/", $image_parts[0]);

                $image_parts = explode(";base64,", $base64);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];

                $image_base64 = base64_decode($image_parts[1]);
                $fileName = uniqid() . '.jpeg';
                $image = $folderPath . $fileName;
                Storage::put($image, $image_base64);
                $photo_pulang = $fileName;
            } catch (\Exception $e) {
                return $this->error('Terjadi kesalahan saat menyimpan photo');
            }

            $validator = Validator::make($request->only('latLong'), [
                'latLong'   => 'required|string'
            ]);

            DB::beginTransaction();
            try {
                //cek ke database jam presensi masuk user contoh format jam 07:00:00
                $jam_masuk_user = Carbon::parse($presensi->jam_masuk);

                //jam masuk tanpa toleransi waktu
                $batas_jam_masuk = Carbon::parse(env('JAM_MASUK'));

                //ketentuan jam pulang, senin-kamis jam 16:00:00, hari jumat jam 16:30:00
                $hari_ini = $current_time->format('l');
                $jam_pulang = Carbon::parse($hari_ini === 'Friday' ? env('JAM_PULANG_HARI_JUMAT') : env('JAM_PULANG'));

                //tepat waktu saat ini
                $waktu_sekarang =  Carbon::now();

                //cek apakah user masuk lebih dari jam 07:30:00
                if ($jam_masuk_user->greaterThan($batas_jam_masuk)) {
                    // User terlambat, catat waktunya dalam menit
                    $keterlambatan = $jam_masuk_user->diffInMinutes($batas_jam_masuk);

                    //maksimal keterlambatan yang bisa diganti hanya 30 menit
                    $maksimal_keterlambatan = $keterlambatan > 30 ? 30 : $keterlambatan;

                    // Tambahkan keterlambatan maksimal pada jam pulang
                    $jam_pulang->addMinutes($maksimal_keterlambatan);

                    //waktu saat user presensi
                    if ($waktu_sekarang->lessThan($jam_pulang)) {
                        $waktu_pulang_cepat = $jam_pulang->diffInMinutes($waktu_sekarang);
                        $status_pulang = 'Lebih awal ' . $waktu_pulang_cepat . ' ' . 'menit';
                        pengurangan_tpp($waktu_pulang_cepat);
                    } else {
                        $status_pulang = 'Tepat waktu';
                    }
                } else if ($waktu_sekarang->lessThan($jam_pulang)) {
                    $waktu_pulang_cepat = $jam_pulang->diffInMinutes($waktu_sekarang);
                    pengurangan_tpp($waktu_pulang_cepat);
                    $status_pulang = 'Lebih awal ' . $waktu_pulang_cepat . ' ' . 'menit';
                } else {
                    $status_pulang = 'Tepat waktu';
                }


                //save data presensi pulang
                $data['opd_id']     = $user->opd_id;
                $data['user_id']    = $user->id;
                $data['tanggal']    = date('Y-m-d');
                $data['jam_pulang']  = date('H:i:s');
                $data['lat_long_pulang']  = $request->latLong;
                $data['photo_pulang']     = $photo_pulang;
                $data['status_pulang']     = $status_pulang;
                $presensi->update($data);

                //clear cache
                Cache::forget('table_dashboard_' . Auth::user()->id);
                Cache::forget('absen_' . Auth::user()->id);
            } catch (Throwable $e) {
                DB::rollback();
                saveLogs($e->getMessage() . ' ' . 'presensi sore', 'error');
                return $this->error($e->getMessage());
            }

            DB::commit();
            return $this->success('presensi_sore', 'Anda Berhasil Mengisi Presensi Sore');
            //prensi pulang end

        } else {
            //presensi masuk start
            $currentTime = Carbon::now();
            $jamMasuk = Carbon::parse(env('JAM_MASUK_TOLERANSI')); // Jam 08:00:00

            $jamMulai = Carbon::parse(env('JAM_AWAL_MASUK')); // Jam 6 pagi
            $jamSelesai = Carbon::parse(env('JAM_AKHIR_MASUK')); // Jam 12 siang

            if (!$currentTime->between($jamMulai, $jamSelesai)) {
                return $this->warning('Presensi pagi dimulai dari jam 06.00 sampai jam 12.00 siang!');
            }

            if ($currentTime > $jamMasuk) {
                $telat = $currentTime->diff($jamMasuk);

                // Mendapatkan total keterlambatan dalam menit
                $terlambat = Carbon::parse(env('JAM_MASUK'));
                $keterlambatan = $currentTime->diffInMinutes($terlambat);

                $status = 'Telat ' . $telat->format('%H:%I:%S'); //catat keterlambatan
            } else {
                $status = 'Tepat waktu';
            }

            $validator = Validator::make($request->only('latLong'), [
                'latLong'   => 'required|string'
            ]);

            if ($validator->fails()) {
                return $this->error($validator->errors());
            }

            try {
                $base64 = $request->base64;
                // Contoh menyimpan file ke storage
                $folderPath = "public/images/" . date('Y') . '/';
                $image_parts = explode(";base64,", $base64);
                $image_type_aux = explode("image/", $image_parts[0]);

                $image_parts = explode(";base64,", $base64);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];

                $image_base64 = base64_decode($image_parts[1]);
                $fileName = uniqid() . '.jpeg';
                $image = $folderPath . $fileName;
                Storage::put($image, $image_base64);
                $photo_masuk = $fileName;
            } catch (\Exception $e) {
                return $this->error('Terjadi kesalahan saat menyimpan photo');
            }

            $data['opd_id']     = $user->opd_id;
            $data['user_id']    = $user->id;
            $data['tanggal']    = Carbon::now()->toDateString(); // Format Y-m-d
            $data['jam_masuk']  = Carbon::now()->toTimeString(); // Format H:i:s
            $data['lat_long_masuk']  = $request->latLong;
            $data['photo_masuk']     = $photo_masuk;
            $data['status'] = $status;

            DB::beginTransaction();
            try {

                $this->presensi->store($data);
                //catat jam masuk user
                $jam_masuk = Carbon::now();

                //batas maksimal jam masuk user dengan tolerasni waktu 30 menit
                $batas_jam_masuk = Carbon::parse(env('JAM_MASUK_TOLERANSI'));

                //cek apakah user masuk di atas jam 8
                if ($jam_masuk->greaterThan($batas_jam_masuk)) {
                    // User terlambat, catat waktunya
                    $keterlambatan = $jam_masuk->diffInMinutes($batas_jam_masuk);
                    pengurangan_tpp($keterlambatan);
                }
            } catch (Throwable $e) {
                DB::rollback();
                saveLogs($e->getPrevious()->getMessage() . ' ' . 'presensi pagi', 'error');
                return $this->error($e->getMessage());
            }

            //hitung jumlah user
            Presensicount();

            //clear cache
            Cache::forget('table_dashboard_' . Auth::user()->id);
            Cache::forget('hadir_' . Auth::user()->id);
            $data = [
                'presensi_pagi' => true,
                'perangkatId'   => $user->id
            ];

            DB::commit();
            return $this->success($data, 'Anda Berhasil Mengisi Presensi Pagi');
        }
    }
}
