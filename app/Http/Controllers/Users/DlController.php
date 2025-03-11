<?php

namespace App\Http\Controllers\Users;

use Throwable;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\PresensiService;
use App\Models\Approval;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;


class DlController extends Controller
{
    protected $presensi;
    public function __construct(PresensiService $presensiService)
    {
        $this->presensi = $presensiService;
    }

    public function index()
    {
        $user_id = Approval::where('user_id', Auth::user()->id)->first();

        if(empty($user_id)) {
            $data['title'] = "Atur pemberi persetujuan";
            $data['description'] = "Operator Anda belum mengatur siapa yang dapat memberikan persetujuan Dinas Luar (DL) Anda";
            return view('pages.index', $data);
        }

        $data['title'] = "Dinas Luar";
        return view('users.dl.index', $data);
    }

    public function store(Request $request)
    {
        //cek apakah user sudah presnsi atau belum
        $user = Auth::user();

        $presensi = $this->presensi->Query()
        ->where('user_id', $user->id)
        ->whereDate('created_at', Carbon::now()->toDateString())
        ->first();

        if ($presensi && $presensi->status == "Dinas Luar (DL)") {
            return $this->warning('Anda sudah melakukan presensi dinas luar!');
        }

        $data = $request->except('_token');
        $data['status'] = 'Dinas Luar (DL)';
        $data['approval_status'] = 'pending';

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
            $photo = $fileName;
        } catch (\Exception $e) {
            return $this->error('Terjadi kesalahan saat menyimpan photo');
        }

        if ($request->hasFile('spt')) {
            $data['spt'] = $request->file('spt')->store('public/spt');
        }

        $data['opd_id']     = $user->opd_id;
        $data['user_id']    = $user->id;
        $data['tanggal']    = Carbon::now()->toDateString();

        $data['jam_masuk']       = Carbon::now()->toTimeString();
        $data['lat_long_masuk']  = $request->latLong;
        $data['photo_masuk']     = $photo;

        $data['jam_pulang']  = Carbon::now()->toTimeString();
        $data['lat_long_pulang']  = $request->latLong;
        $data['photo_pulang']     = $photo;
        $data['status_pulang']    = 'DL ' . Carbon::now()->toTimeString();;

        if ($presensi) {
            try {
                $this->presensi->update($presensi, $data);
            } catch (Throwable $e) {
                saveLogs($e->getMessage() . ' ' . 'presensi pagi', 'error');
                return $this->error($e->getMessage());
            }
        } else {
            try {
                $this->presensi->store($data);
            } catch (Throwable $e) {
                saveLogs($e->getMessage() . ' ' . 'presensi pagi', 'error');
                return $this->error($e->getMessage());
            }
        }

        Presensicount();
        Cache::forget('table_dashboard_' . Auth::user()->id);
        Cache::forget('hadir_' . Auth::user()->id);
        return $this->success($data, 'Anda Berhasil Mengisi Presensi Dinas Luar (DL)');
    }
}
