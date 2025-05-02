<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\HapusAkun;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HapusAkunController extends Controller
{
    public function index()
    {
        return view('users.hapus_akun.index', [
            'title' => 'Penghapusan Akun'
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'alasan'    => 'required',
            'lampiran'  => 'required|mimes:png,jpg,jpeg,pdf|max:2048'
        ]);

        if($validator->fails()) {
            return $this->error($validator->errors());
        }

        $lampiranPath = null;
        if ($request->hasFile('lampiran')) {
            $lampiranPath = $request->file('lampiran')->store('hapus_akun/lampiran', 'public');
        }

        HapusAkun::create([
            'user_id'   => Auth::id(),
            'alasan'    => $request->alasan,
            'lampiran'  => $lampiranPath,
        ]);

        return $this->success('Ok', 'Pengajuan hapus akun berhasil dikirim. Selanjutnya Admin akan memproses pengajuan Anda dan akan meberitahuan hasilnya lewat email Anda');
    }
}
