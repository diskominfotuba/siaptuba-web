<?php

namespace App\Http\Controllers\BKPP;

use App\Http\Controllers\Controller;
use App\Models\BkppBerkasPengajuan;
use App\Models\BkppKomentar;
use App\Models\BkppLayanan;
use App\Models\BkppPengajuan;
use App\Models\Dokumen;
use App\Services\BaseService;
use App\Services\BkppService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LayananController extends Controller
{
    public $pengajuan;
    public $berkas;
    public $komentar;
    public $layanan;
    public function __construct(BkppPengajuan $pengajuan, BkppLayanan $bkppLayanan, BkppBerkasPengajuan $berkas, BkppKomentar $komentar)
    {
        $this->pengajuan = new BkppService($pengajuan);
        $this->berkas = new BkppService($berkas);
        $this->komentar = new BkppService($komentar);
        $this->layanan = new BkppService($bkppLayanan);
    }

    public function index(Request $request, $layanan_id)
    {
        $pengajuan = $this->pengajuan->Query()->whereIn('status', ['terverifikasi operator', 'pending', 'diproses', 'selesai', 'ditolak bkpp']);
        if ($request->ajax()) {
            $status = $request->status;
            if ($status) {
                $data['table'] = $pengajuan->where('layanan_id', $layanan_id)->where('status', $status)->with('user')->paginate();
            } else {
                $data['table'] = $pengajuan->where('layanan_id', $layanan_id)->with('user')->paginate();
            }
            return view('bkpp.layanan._data_table', $data);
        }
        $data['title'] = $this->layanan->Query()->where('id', $layanan_id)->pluck('nama_layanan')->first();
        $data['pengajuan_baru'] = $this->pengajuan->Query()->where('layanan_id', $layanan_id)->whereIn('status', ['terverifikasi operator', 'pending'])->count();
        $data['pengajuan_diproses'] = $this->pengajuan->Query()->where('layanan_id', $layanan_id)->where('status', 'diproses')->count();
        $data['pengajuan_diterima'] = $this->pengajuan->Query()->where('layanan_id', $layanan_id)->where('status', 'selesai')->count();
        $data['pengajuan_ditloak'] = $this->pengajuan->Query()->where('layanan_id', $layanan_id)->where('status', 'ditolak bkpp')->count();
        return view('bkpp.layanan.index', $data);
    }

    public function show(Request $request)
    {
        $pengajuan_id = $request->pengajuan_id;
        $pengajuan = $this->pengajuan->find($pengajuan_id);
        if ($request->ajax()) {
            $data['komentar'] = $this->komentar->Query()->where('pengajuan_id', $pengajuan->id)->with('user')->get();
            return view('bkpp.layanan._komentar', $data);
        }

        $data['title'] = $this->layanan->Query()->where('id', $request->layanan_id)->pluck('nama_layanan')->first();
        $data['pengajuan'] =  $pengajuan;
        $data['berkas'] = $this->berkas->Query()->with('input')->where('pengajuan_id', $pengajuan_id)->get();
        return view('bkpp.layanan.show', $data);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors());
        }

        $pengajuan = $this->pengajuan->find($request->pengajuan_id);
        if ($pengajuan) {
            $file = $request->file('file');
            $file->storeAs('public/dokumen/' . $pengajuan->created_at->format('Y') . '/' . $pengajuan->user->id, $file->hashName());
            $data['file'] = $file->hashName();
            $data['status'] = "diterima";

            try {
                $this->pengajuan->update($pengajuan, $data);
            } catch (\Throwable $th) {
                return $this->error($th->getMessage());
            }

            return $this->success('OK', "File berhasil terkirim");
        } else {
            return $this->error("Data not found!");
        }
    }

    public function updateDitolak(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'komentar' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors());
        }

        $pengajuan = $this->pengajuan->find($request->pengajuan_id);
        if ($pengajuan) {
            $data['status'] = "ditolak bkpp";
            $dataKomentar['user_id'] = Auth::id();
            $dataKomentar['pengajuan_id'] = $request->pengajuan_id;
            $dataKomentar['komentar'] = $request->komentar;

            try {
                $this->komentar->store($dataKomentar);
                $this->pengajuan->update($pengajuan, $data);
            } catch (\Throwable $th) {
                return $this->error($th->getMessage());
            }

            return $this->success('OK', "Data berhasil diperbarui");
        } else {
            return $this->error("Data not found!");
        }
    }

    public function updateDiproses(Request $request)
    {
        $pengajuan = $this->pengajuan->find($request->pengajuan_id);
        if ($pengajuan) {
            $data['status'] = "diproses";

            try {
                $this->pengajuan->update($pengajuan, $data);
            } catch (\Throwable $th) {
                return $this->error($th->getMessage());
            }

            return $this->success('OK', "Data berhasil diperbarui");
        } else {
            return $this->error("Data not found!");
        }
    }

    public function updateSelesai(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors());
        }

        $pengajuan = $this->pengajuan->find($request->pengajuan_id);
        if ($pengajuan) {
            $file = $request->file('file');
            if ($file->isValid()) {
                $pathFile = 'dokumen_kepegawaian/' . Auth::id() . '/produk_kepegawaian';
                $file->storeAs($pathFile, $file->hashName(), 's3');
                $data['file'] = $file->hashName();
            }
            $data['status'] = "selesai";

            try {
                $this->pengajuan->update($pengajuan, $data);
            } catch (\Throwable $th) {
                return $this->error($th->getMessage());
            }

            return $this->success('OK', "Data berhasil diperbarui");
        } else {
            return $this->error("Data not found!");
        }
    }
}
