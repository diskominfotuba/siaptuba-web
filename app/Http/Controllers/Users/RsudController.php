<?php

namespace App\Http\Controllers\Users;

use Throwable;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\PresensiService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class RsudController extends Controller
{
    protected $presensi;
    public function __construct(PresensiService $presensiService)
    {
        $this->presensi = $presensiService;
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $presensi = $this->presensi->Query()
        ->where('user_id', $user->id)
        ->whereDate('created_at',  Carbon::now()->toDateString())
        ->latest()
        ->first();

        if ($presensi && empty($presensi->jam_pulang)) {
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


            $data['opd_id']     = $user->opd_id;
            $data['user_id']    = $user->id;
            $data['tanggal']    = Carbon::now()->toDateString();
            $data['jam_pulang']  = Carbon::now()->toTimeString();  
            $data['lat_long_pulang']  = $request->latLong;
            $data['photo_pulang']     = $photo_pulang;
            $data['status_pulang']     = Carbon::now()->toTimeString();

            try {
                $this->presensi->update($presensi, $data);
            } catch (Throwable $e) {
                saveLogs($e->getMessage() . ' ' . 'presensi sore', 'error');
                return $this->error($e->getMessage());
            }
            //clear cache
            Cache::forget('table_dashboard_' . Auth::user()->id);
            Cache::forget('hadir_' . Auth::user()->id);
            Cache::forget('absen_' . Auth::user()->id);
            return $this->success('OK', 'Anda Berhasil Mengisi Presensi Pulang');
            
        }else {
            $data = $request->except('_token');
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
                $photo_masuk = $fileName;
            } catch (\Exception $e) {
                return $this->error('Terjadi kesalahan saat menyimpan photo');
            }

            $data['opd_id']     = $user->opd_id;
            $data['user_id']    = $user->id;
            $data['tanggal']    = Carbon::now()->toDateString();
            $data['jam_masuk']  = Carbon::now()->toTimeString();
            $data['lat_long_masuk']  = $request->latLong;
            $data['photo_masuk']     = $photo_masuk;
            $data['status'] = Carbon::now()->toTimeString();

            try {
                $this->presensi->store($data);
            } catch (Throwable $e) {
                saveLogs($e->getMessage() . ' ' . 'presensi pagi', 'error');
                return $this->error($e->getMessage());
            }
            Presensicount();
              //clear cache
            Cache::forget('table_dashboard_' . Auth::user()->id);
            Cache::forget('hadir_' . Auth::user()->id);
            return $this->success($data, 'Anda Berhasil Mengisi Presensi masuk');
        }
    }
}
