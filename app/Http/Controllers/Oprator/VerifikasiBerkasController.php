<?php

namespace App\Http\Controllers\Oprator;

use App\Http\Controllers\Controller;
use App\Models\BkppBerkasPengajuan;
use App\Models\BkppKomentar;
use App\Models\BkppLayanan;
use App\Models\BkppPengajuan;
use App\Services\BkppService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class VerifikasiBerkasController extends Controller
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

    public function index(Request $request)
    {
        $pengajuan = $this->pengajuan->Query()->whereHas('user', function ($query) {
            $query->where('opd_id', Auth::user()->opd_id);
        });
        if ($request->ajax()) {
            $status = $request->status;
            if ($status) {
                $data['table'] = $pengajuan->where('status', $status)->with('user')->paginate();
            } else {
                $data['table'] = $pengajuan->with('user')->paginate();
            }
            return view('oprator.verifikasiberkas._data_table', $data);
        }
        $data['title'] = "Verifikasi Berkas";
        $data['pengajuan_diajukan'] = $this->pengajuan->Query()->where('status', 'diajukan')->count();
        $data['pengajuan_ditolak'] = $this->pengajuan->Query()->where('status', 'ditolak operator')->count();
        $data['pengajuan_terverifikasi'] = $this->pengajuan->Query()->where('status', 'terverifikasi operator')->count();
        return view('oprator.verifikasiberkas.index', $data);
    }

    public function show(Request $request)
    {
        $pengajuan_id = $request->pengajuan_id;
        $pengajuan = $this->pengajuan->find($pengajuan_id);
        if ($request->ajax()) {
            $data['komentar'] = $this->komentar->Query()->where('pengajuan_id', $pengajuan->id)->with('user')->get();
            return view('oprator.verifikasiberkas._komentar', $data);
        }

        $data['title'] = "Verifikasi Berkas";
        $data['pengajuan'] =  $pengajuan;
        $data['berkas'] = $this->berkas->Query()->with('input')->where('pengajuan_id', $pengajuan_id)->get();
        return view('oprator.verifikasiberkas.show', $data);
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
            $data['status'] = "ditolak operator";
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

    public function updateDiverifikasi(Request $request)
    {
        $pengajuan = $this->pengajuan->find($request->pengajuan_id);
        if ($pengajuan) {
            $data['status'] = "terverifikasi operator";

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
