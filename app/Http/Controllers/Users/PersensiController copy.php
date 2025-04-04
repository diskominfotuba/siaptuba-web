<?php

namespace App\Http\Controllers\Users;

use Throwable;
use App\Models\Izin;
use App\Jobs\PresensiJob;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Services\PresensiService;
use App\Http\Controllers\Controller;
use App\Jobs\PresensiupdateJob;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

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
        $data['nama'] = explode(" ", Auth::user()->nama);
        $data['lat'] = Auth::user()->opd->lat;
        $data['long'] = Auth::user()->opd->long;
        return view('users.persensi.index', $data);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $presensi = $this->presensi->Query()
        ->where('user_id', $user->id)
        ->where('tanggal',  date('Y-m-d'))
        ->latest()
        ->first();

        $cuti = Izin::where('user_id', $user->id)->latest()->first();
        if($cuti) {
             $tanggalMasukCuti = Carbon::createFromDate($cuti->tanggal_masuk);
            // Periksa apakah tanggal tersebut sudah lewat dari hari ini
            if (!$tanggalMasukCuti->isPast()) {
                return $this->error("Anda masih dalam masa cuti");
            }
        }

        if($presensi) {
            //cek apakah sudah mengisi presensi pulang
            if (isset($presensi->jam_pulang)) {
                return $this->error('Hari Ini Anda Sudah Mengisi Presensi 2X!');
            }

            $currentTime = Carbon::now();
            $jamMulai = Carbon::createFromTime(14, 0, 0); // Jam 14 pagi
            $jamSelesai = Carbon::createFromTime(18, 0, 0); // Jam 16 siang

            if (!$currentTime->between($jamMulai, $jamSelesai)) {
                return $this->error('Presensi sore dimulai dari jam 14.00 sampai jam 18.00 sore!');
            }

            $file = $request->file;
            if (strlen($file) > 30) {
                if (pathinfo($file, PATHINFO_EXTENSION) !== 'jpeg') {
                    $img =  $file;
                    $folderPath = "public/users/img/";

                    $image_parts = explode(";base64,", $img);
                    $image_type_aux = explode("image/", $image_parts[0]);
                    $image_type = $image_type_aux[1];

                    $image_base64 = base64_decode($image_parts[1]);
                    $fileName = uniqid() . '.jpeg';

                    $file = $folderPath . $fileName;
                    Storage::put($file, $image_base64);
                    $photo_pulang = $fileName;
                }
            } else {
                $photo_pulang = $file;
            }

            $hari = $currentTime->format('l');
            if ($hari === 'Friday') {
                $waktuPulang =  Carbon::createFromTime(16, 30, 0);
            } else {
                $waktuPulang = Carbon::createFromTime(16, 00, 0);
            }
            // Membuat objek Carbon untuk pukul 15:30:00
            $batasWaktu = $waktuPulang;

            // Memeriksa apakah waktu saat ini lebih kecil dari $batasWaktu
            if ($currentTime->lessThan($batasWaktu)) {
                // Kondisi jika waktu saat ini lebih kecil dari 15:30:00
                $statusPulang = 'Lebih awal ' . date('H:i:s');
                // if(Auth::user()->opd_id == '20') {
                //     //hitung tpp
                //     $tpp_pegawai = Auth::user()->tpp;
                //     $tpp_akhir = Auth::user()->tpp_akhir;

                //     if ($tpp_pegawai !== '0') {
                //         // Mendapatkan total keterlambatan dalam menit
                //         $pulangLebihhAwal = $currentTime->diffInMinutes($batasWaktu);
                        
                //         // Menghitung potongan berdasarkan rentang keterlambatan
                //         if ($pulangLebihhAwal >= 1 && $pulangLebihhAwal <= 30) {
                //             $potongan_tpp = 0.5 /100 * $tpp_pegawai; // 0.50% potongan
                //         } elseif ($pulangLebihhAwal >= 31 && $pulangLebihhAwal <= 60) {
                //             $potongan_tpp = 1 / 100 * $tpp_pegawai; // 1% potongan
                //         } elseif ($pulangLebihhAwal >= 61 && $pulangLebihhAwal <= 90) {
                //             $potongan_tpp = 1.25 / 100 * $tpp_pegawai; // 1.25% potongan
                //         } elseif ($pulangLebihhAwal >= 91 && $pulangLebihhAwal <= 120) {
                //             $potongan_tpp = 1.5 / 100 * $tpp_pegawai; // 1.50% potongan
                //         }else {
                //             $potongan_tpp = 0;
                //         }

                //         if($tpp_akhir > 0) {
                //             $tpp_hasil_pengurangan = $tpp_akhir - $potongan_tpp;
                //         }else {
                //             $tpp_hasil_pengurangan = $tpp_pegawai - $potongan_tpp;
                //         }
                //     }else {
                //         $tpp_hasil_pengurangan = Auth::user()->tpp;
                //     }

                //     //cek apakah ada keterlamabatan jam masuk kerja
                //     if($presensi->jam_masuk) {
                //         //
                //     }
                //     $statusPulang = 'Lebih awal ' . date('H:i:s');

                // }else {
                //     $tpp_hasil_pengurangan = Auth::user()->tpp;
                //     $statusPulang = 'Lebih awal ' . date('H:i:s');
                //     if(Auth::user()->opd_id == '20') {
                //         $tpp_akhir = Auth::user()->tpp_akhir;
                //         if($tpp_akhir > 0) {
                //             $tpp_hasil_pengurangan = $tpp_akhir;
                //         }else {
                //             $tpp_hasil_pengurangan = Auth::user()->tpp;
                //         }
                //     }else {
                //         $tpp_hasil_pengurangan = Auth::user()->tpp;
                //     }
                // }
                
            } else {
                // Kondisi jika waktu saat ini sama atau lebih besar dari 16:00:00
                $statusPulang = 'Tepat waktu';

                //cek apakah user pulang lebih dari jam 16:00:00
                // if($currentTime > $waktuPulang) {
                //     $lembur = $currentTime->diff($waktuPulang);
                // }

                // cek apakah ada keterlambatan jam masuk kerja
                // $presensiStart = Carbon::createFromTimeString('07:30:00');
                // $jamMasuk = Carbon::createFromTimeString($presensi->jam_masuk);

                // if ($jamMasuk->gt($presensiStart)) {
                //     // atau hitung keterlambatan dalam jam dan menit
                //     $late = $presensiStart->diff($jamMasuk);
                    
                //     // contoh penggunaan $late
                //     $hours = $late->h; // jumlah jam keterlambatan
                //     $minutes = $late->i; // jumlah menit keterlambatan
                    
                //     echo "Keterlambatan: $hours jam $minutes menit";
                // }

                // if(Auth::user()->opd_id == '20') {
                //     $tpp_akhir = Auth::user()->tpp_akhir;
                //     if($tpp_akhir > 0) {
                //         $tpp_hasil_pengurangan = $tpp_akhir;
                //     }else {
                //         $tpp_hasil_pengurangan = Auth::user()->tpp;
                //     }
                // }else {
                //     $tpp_hasil_pengurangan = Auth::user()->tpp;
                // }
            }

            $data['opd_id']     = $user->opd_id;
            $data['user_id']    = $user->id;
            $data['tanggal']    = date('Y-m-d');
            $data['jam_pulang']  = date('H:i:s');
            $data['lat_long_pulang']  = $request->latLong;
            $data['photo_pulang']     = $photo_pulang;
            $data['status_pulang']     = $statusPulang;

            //update tpp
            $user->update(['tpp_akhir' => $tpp_hasil_pengurangan]);

            try {
                $this->presensi->update($presensi, $data);
                //clear cache
                Cache::forget('table_dashboard_' . Auth::user()->id);
                Cache::forget('absen_' . Auth::user()->id);
            } catch (Throwable $e) {
                saveLogs($e->getMessage() . ' ' . 'presensi sore', 'error');
                return $this->error($e->getMessage());
            }
            return $this->success('presensi_sore', 'Anda Berhasil Mengisi Presensi Sore');
            //prensi pulang end
        } else {
            //presensi masuk start
            $currentTime = Carbon::now();
            $jamMasuk = Carbon::parse(config('app.jam_masuk'));

            $jamMulai = Carbon::createFromTime(6, 0, 0); // Jam 6 pagi
            $jamSelesai = Carbon::createFromTime(12, 0, 0); // Jam 12 siang

            if (!$currentTime->between($jamMulai, $jamSelesai)) {
                return $this->error('Presensi pagi dimulai dari jam 6.00 sampai jam 12.00 Siang!');
            }

            if ($currentTime > $jamMasuk) {
                $telat = $currentTime->diff($jamMasuk);

                if(Auth::user()->opd_id == '20') {
                    //hitung tpp
                    $tpp_pegawai = Auth::user()->tpp;
                    $tpp_akhir = Auth::user()->tpp_akhir;

                    if ($tpp_pegawai !== '0') {
                        // Mendapatkan total keterlambatan dalam menit
                        $terlambat = Carbon::createFromTimeString(config('app.jam_masuk'));
                        $keterlambatan = $currentTime->diffInMinutes($terlambat);
                        pengurangan_tpp($keterlambatan);


                        // Menghitung potongan berdasarkan rentang keterlambatan
                        if ($keterlambatan >= 1 && $keterlambatan <= 30) {
                            $potongan_tpp = 0.2 / 100 * $tpp_pegawai; // 0.50% potongan
                        } elseif ($keterlambatan >= 31 && $keterlambatan <= 60) {
                            $potongan_tpp = 0.4 / 100 * $tpp_pegawai; // 1% potongan
                        } elseif ($keterlambatan >= 61 && $keterlambatan <= 90) {
                            $potongan_tpp = 0.5 / 100 * $tpp_pegawai; // 1.25% potongan
                        } elseif ($keterlambatan >= 91 && $keterlambatan <= 120) {
                            $potongan_tpp = 0.6 / 100 * $tpp_pegawai; // 1.50% potongan
                        }else {
                            $potongan_tpp = 0.6 / 100 * $tpp_pegawai;
                        }
                        // Kurangi total potongan dari TPP untuk mendapatkan TPP akhir setelah potongan
                        if($tpp_akhir > 0) {
                            $tpp_hasil_pengurangan = $tpp_akhir - $potongan_tpp;
                        }else {
                            $tpp_hasil_pengurangan = $tpp_pegawai - $potongan_tpp;
                        }
                    }
                }
                
                $tpp_hasil_pengurangan = Auth::user()->tpp;
                $status = 'Telat ' . $telat->format('%H:%I:%S'); //catat keterlambatan
            }else {
                $status = 'Tepat waktu';
                $tpp_hasil_pengurangan = Auth::user()->tpp;
            }

            $data = $request->except('_token');
            $data['status'] = $status;

            $file = $request->file;
            if (strlen($file) > 30) {
                if (pathinfo($file, PATHINFO_EXTENSION) !== 'jpeg') {
                    $img =  $file;
                    $folderPath = "public/users/img/";

                    $image_parts = explode(";base64,", $img);
                    $image_type_aux = explode("image/", $image_parts[0]);
                    $image_type = $image_type_aux[1];

                    $image_base64 = base64_decode($image_parts[1]);
                    $fileName = uniqid() . '.jpeg';

                    $file = $folderPath . $fileName;
                    Storage::put($file, $image_base64);
                    $photo_masuk = $fileName;
                }
            } else {
                $photo_masuk = $file;
            }

            $data['opd_id']     = $user->opd_id;
            $data['user_id']    = $user->id;
            $data['tanggal']    = date('Y-m-d');
            $data['jam_masuk']  = date('H:i:s');
            $data['lat_long_masuk']  = $request->latLong;
            $data['photo_masuk']     = $photo_masuk;
            
            //update tpp
            $user->update(['tpp_akhir' => $tpp_hasil_pengurangan]);

            try {
                $this->presensi->store($data);
            } catch (Throwable $e) {
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
            return $this->success($data, 'Anda Berhasil Mengisi Presensi Pagi');
        }
    }

    public function storeFile(Request $request)
    {
        $img =  $request->image;
        $folderPath = "public/users/img/";

        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.jpeg';

        $file = $folderPath . $fileName;
        Storage::put($file, $image_base64);
        // return $this->success($fileName);
    }

    public function removeFile(Request $request)
    {
        $filePath = storage_path('app/public/users/img/') . $request->file;

        if (file_exists($filePath)) {
            unlink($filePath);
            return $this->success('ok', 'photo berhasil dihapus');
        } else {
            return $this->error('not_found', 'photo tidak ditemukan');
        }
    }
}
