<?php

namespace App\Http\Controllers\BKPP\Master;

use App\Http\Controllers\Controller;
use App\Models\BkppInputLayanan;
use App\Models\BkppKategoriLayanan;
use App\Models\BkppLayanan;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class InputLayananController extends Controller
{
    public $layanan;
    public $input;
    public $kategori;
    public function __construct(BkppLayanan $bkppLayanan, BkppInputLayanan $bkppInputLayanan, BkppKategoriLayanan $bkppKategoriLayanan)
    {
        $this->layanan = new BaseService($bkppLayanan);
        $this->input = new BaseService($bkppInputLayanan);
        $this->kategori = new BaseService($bkppKategoriLayanan);
    }

    public function index(Request $request, $kategori_id, $layanan_id)
    {
        if ($request->ajax()) {
            $data['table'] = $this->input->Query()->where('layanan_id', $layanan_id)->paginate(10);
            return view('bkpp.master.inputlayanan._data_input', $data);
        }
        $kategori = $this->kategori->Query()->where('id', $kategori_id)->first();
        $layanan = $this->layanan->Query()->where('id', $layanan_id)->first();
        return view('bkpp.master.inputlayanan.index', compact('kategori', 'layanan'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make(\request()->all(), [
            'nama_input'  => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors());
        }

        $data = \request()->except('_token');
        $data['slug'] = Str::slug($data['nama_input']);
        $data['layanan_id'] = $request->layanan_id;
        try {
            $this->input->store($data);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
        return $this->success($data, 'Data berhasil ditambahkan');
    }

    public function update(Request $request)
    {
        $validator = Validator::make(\request()->all(), [
            'nama_input'  => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors());
        }

        $data = \request()->except('_token');
        $data['slug'] = Str::slug($data['nama_input']);

        $input = $this->input->find($request->id);
        try {
            $this->input->update($input, $data);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
        return $this->success($data, 'Data berhasil diperbarui');
    }

    public function destroy(Request $request)
    {
        try {
            $this->input->delete($request->id);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
        return $this->success('Data berhasil dihapus');
    }

    public function updateStatus(Request $request, $input_id)
    {
        $dataCheck = $this->input->find($input_id);
        if ($dataCheck['required'] == "n") {
            $data['required'] = "y";
        } else {
            $data['required'] = "n";
        }
        try {
            $this->input->update($dataCheck, $data);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }

        return $this->success('OK', 'Status berkas berhasil diperbaharui');
    }
}
