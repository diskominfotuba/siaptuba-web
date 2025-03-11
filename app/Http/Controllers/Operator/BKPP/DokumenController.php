<?php

namespace App\Http\Controllers\BKPP;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DokumenService;

class DokumenController extends Controller
{
    protected $dokumen;
    public function __construct(DokumenService $dokumenService)
    {
        $this->dokumen = $dokumenService;
    }

    public function store(Request $request)
    {
        if($request->ajax()) {
            $dokumen = $this->dokumen->Query()->where('user_id', Auth::user()->id)->first();
            if($dokumen) {
                $validator = Validator::make($request->all(), [
                    'sk_cpns_legalisir' => 'mimes:pdf|max:2048',
                    'sk_pns_legalisir' => 'mimes:pdf|max:2048',
                    'sk_pangkat_terakhir_legalisir' => 'mimes:pdf|max:2048',
                    'ijazah_dan_transkrip_nilai' => 'mimes:pdf|max:2048',
                ]);
    
                if($validator->fails()) {
                    return $this->error($validator->errors());
                }
    
                if($request->hasFile('sk_cpns_legalisir')) {
                    $sk_cpns_legalisir = $request->file('sk_cpns_legalisir');
                    $sk_cpns_legalisir->storeAs('public/dokumen/'. Auth::user()->id . '/' . date('Y'), $sk_cpns_legalisir->hashName());
                    $sk_cpns_legalisir = $sk_cpns_legalisir->hashName();
                }else {
                    $sk_cpns_legalisir = $dokumen->sk_cpns_legalisir;
                }
    
                if($request->hasFile('sk_pns_legalisir')) {
                    $sk_pns_legalisir = $request->file('sk_pns_legalisir');
                    $sk_pns_legalisir->storeAs('public/dokumen/' . date('Y'), $sk_pns_legalisir->hashName());
                    $sk_pns_legalisir = $sk_pns_legalisir->hashName();
                }else {
                    $sk_pns_legalisir = $dokumen->sk_pns_legalisir;
                }
    
                if($request->hasFile('sk_pangkat_terakhir_legalisir')) {
                    $sk_pangkat_terakhir_legalisir = $request->file('sk_pangkat_terakhir_legalisir');
                    $sk_pangkat_terakhir_legalisir->storeAs('public/dokumen/' . date('Y'), $sk_pangkat_terakhir_legalisir->hashName());
                    $sk_pangkat_terakhir_legalisir = $sk_pangkat_terakhir_legalisir->hashName();
                }else {
                    $sk_pangkat_terakhir_legalisir = $dokumen->sk_pangkat_terakhir_legalisir;
                }
    
                if($request->hasFile('ijazah_dan_transkrip_nilai')) {
                    $ijazah_dan_transkrip_nilai = $request->file('ijazah_dan_transkrip_nilai');
                    $ijazah_dan_transkrip_nilai->storeAs('public/dokumen/' . date('Y'), $ijazah_dan_transkrip_nilai->hashName());
                    $ijazah_dan_transkrip_nilai = $ijazah_dan_transkrip_nilai->hashName();
                }else {
                    $ijazah_dan_transkrip_nilai = $dokumen->ijazah_dan_transkrip_nilai;
                }
    
                //simpan data
                $data['user_id'] = Auth::user()->id;
                $data['sk_cpns_legalisir'] = $sk_cpns_legalisir;
                $data['sk_pns_legalisir'] = $sk_pns_legalisir;
                $data['sk_pangkat_terakhir_legalisir'] = $sk_pangkat_terakhir_legalisir;
                $data['ijazah_dan_transkrip_nilai'] = $ijazah_dan_transkrip_nilai;
    
                try {
                    $this->dokumen->update($user_id, $data);
                } catch (\Throwable $th) {
                    return $this->error($th->getMessage());
                }
    
                return $this->success('OK', "Dokumen berhasil di simpan");
            }else {
               //insert dokumen
                $validator = Validator::make($request->all(), [
                    'sk_cpns_legalisir' => 'required|mimes:pdf|max:2048',
                    'sk_pns_legalisir' => 'required|mimes:pdf|max:2048',
                    'sk_pangkat_terakhir_legalisir' => 'required|mimes:pdf|max:2048',
                    'ijazah_dan_transkrip_nilai' => 'required|mimes:pdf|max:2048',
                ]);
    
                $sk_cpns_legalisir = $request->file('sk_cpns_legalisir');
                $sk_cpns_legalisir->storeAs('public/dokumen/' . date('Y'), $sk_cpns_legalisir->hashName());
                $sk_cpns_legalisir = $sk_cpns_legalisir->hashName();
    
                $sk_pns_legalisir = $request->file('sk_pns_legalisir');
                $sk_pns_legalisir->storeAs('public/dokumen/' . date('Y'), $sk_pns_legalisir->hashName());
                $sk_pns_legalisir = $sk_pns_legalisir->hashName();
    
                $sk_pangkat_terakhir_legalisir = $request->file('sk_pangkat_terakhir_legalisir');
                $sk_pangkat_terakhir_legalisir->storeAs('public/dokumen/' . date('Y'), $sk_pangkat_terakhir_legalisir->hashName());
                $sk_pangkat_terakhir_legalisir = $sk_pangkat_terakhir_legalisir->hashName();
    
                $ijazah_dan_transkrip_nilai = $request->file('ijazah_dan_transkrip_nilai');
                $ijazah_dan_transkrip_nilai->storeAs('public/dokumen/' . date('Y'), $ijazah_dan_transkrip_nilai->hashName());
                $ijazah_dan_transkrip_nilai = $ijazah_dan_transkrip_nilai->hashName();
    
                if($validator->fails()) {
                    return $this->error($validator->errors());
                }
    
                //simpan data
                $data['user_id'] = Auth::user()->id;
                $data['sk_cpns_legalisir'] = $sk_cpns_legalisir;
                $data['sk_pns_legalisir'] = $sk_pns_legalisir;
                $data['sk_pangkat_terakhir_legalisir'] = $sk_pangkat_terakhir_legalisir;
                $data['ijazah_dan_transkrip_nilai'] = $ijazah_dan_transkrip_nilai;
    
                try {
                    $this->dokumen->store($data);
                } catch (\Throwable $th) {
                    return $this->error($th->getMessage());
                }
    
                return $this->success('OK', "Dokumen berhasil di simpan");
            }
        }else {
            \abort(404);
        }
    }
}
