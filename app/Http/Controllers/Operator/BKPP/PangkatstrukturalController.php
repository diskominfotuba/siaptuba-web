<?php

namespace App\Http\Controllers\BKPP;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\BkppService;
use App\Models\BkppPengajuan;
use App\Models\Dokumen;
use App\Models\BkppKomentar;
class PangkatstrukturalController extends Controller
{
    public $pengajuan;
    public $dokumen;
    public $komentar;
    public function __construct(BkppPengajuan $pengajuan, Dokumen $dokumen, BkppKomentar $komentar) {
        $this->pengajuan = new BkppService($pengajuan);
        $this->dokumen = new BkppService($dokumen);
        $this->komentar = new BkppService($komentar);
    }

    public function index(Request $request)
    {
        $pengajuan = $this->pengajuan->Query();
        if($request->ajax()) {
           $status = $request->status;
           if($status) {
               $data['table'] = $pengajuan->where('id_katpengajuan', '3')->where('status', $status)->with('user')->paginate();
            }else {
               $data['table'] = $pengajuan->where('id_katpengajuan', '3')->with('user')->paginate();
           }
           return \view('bkpp.kenaikanpangkat._data_struktural', $data);
        }
        $data['title'] = "Kenaikan Pangkat Struktural";
        $data['pengajuan_baru'] = $this->pengajuan->Query()->where('id_katpengajuan', '3')->where('status', 'pending')->count();
        $data['pengajuan_diproses'] = $this->pengajuan->Query()->where('id_katpengajuan', '3')->where('status', 'diproses')->count();
        $data['pengajuan_diterima'] = $this->pengajuan->Query()->where('id_katpengajuan', '3')->where('status', 'selesai')->count();
        $data['pengajuan_ditloak'] = $this->pengajuan->Query()->where('id_katpengajuan', '3')->where('status', 'ditolak')->count();
        return view('bkpp.kenaikanpangkat.index', $data);
    }

    public function show(Request $request, $id)
    {
        $pengajuan = $this->pengajuan->find($id);
        if($request->ajax()) {
            $data['komentar'] = $this->komentar->Query()->where('pengajuan_id', $pengajuan->id)->with('user')->get();
            return view('bkpp.kenaikanpangkat._komentar', $data);
        }
       
        //update status pengajuan menjadi diproses
        if($pengajuan->status == "pending") {
            $data['status'] = "diproses";
            try {
                $this->pengajuan->update($pengajuan, $data);
            } catch (\Throwable $th) {
                return \abort(404);
            }
        }
        $data['title'] = "Kenaikan Pangkat Struktural";
        $data['pengajuan'] =  $pengajuan;
        $data['dokumen'] = $this->dokumen->Query()->where('user_id', $pengajuan->id_user)->first();
        return view('bkpp.kenaikanpangkat.show_struktural', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:pdf|max:2048',
        ]);
        
        if($validator->fails()) {
            return $this->error($validator->errors());
        }

        $pengajuan = $this->pengajuan->find($id);
        if($pengajuan) {
            $file = $request->file('file');
            $file->storeAs('public/dokumen/' .$pengajuan->created_at->format('Y') . '/' . $pengajuan->user->id, $file->hashName());
            $data['file'] = $file->hashName();
            $data['status'] = "diterima";

            try {
                $this->pengajuan->update($pengajuan, $data);
            } catch (\Throwable $th) {
                return $this->error($th->getMessage());
            }

            return $this->success('OK', "File berhasil terkirim");
        }else {
            return $this->error("Data not found!");
        }
    }
}
