<?php

namespace App\Http\Controllers\BKPP\Master;

use App\Http\Controllers\Controller;
use App\Models\BkppKategoriLayanan;
use App\Models\BkppLayanan;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LayananController extends Controller
{
    public $layanan;
    public $kategori;
    public function __construct(BkppLayanan $bkppLayanan, BkppKategoriLayanan $bkppKategoriLayanan)
    {
        $this->layanan = new BaseService($bkppLayanan);
        $this->kategori = new BaseService($bkppKategoriLayanan);
    }

    public function index(Request $request, $kategori_id)
    {
        if ($request->ajax()) {
            $data['table'] = $this->layanan->Query()->with('kategori')->where('kategori_id', $kategori_id)->paginate(10);
            return view('bkpp.master.layanan._data_layanan', $data);
        }
        $kategori = $this->kategori->Query()->where('id', $kategori_id)->first();
        return view('bkpp.master.layanan.index', compact('kategori'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make(\request()->all(), [
            'nama_layanan'  => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors());
        }

        $data = \request()->except('_token');
        $data['slug'] = Str::slug($data['nama_layanan']);
        $data['kategori_id'] = $request->kategori_id;
        try {
            $this->layanan->store($data);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
        return $this->success($data, 'Data berhasil ditambahkan');
    }

    public function update(Request $request)
    {
        $validator = Validator::make(\request()->all(), [
            'nama_layanan'  => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors());
        }

        $data = \request()->except('_token');
        $data['slug'] = Str::slug($data['nama_layanan']);

        $layanan = $this->layanan->find($request->id);
        try {
            $this->layanan->update($layanan, $data);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
        return $this->success($data, 'Data berhasil diperbarui');
    }

    public function destroy(Request $request)
    {
        try {
            $this->layanan->delete($request->id);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
        return $this->success('Data berhasil dihapus');
    }
}
