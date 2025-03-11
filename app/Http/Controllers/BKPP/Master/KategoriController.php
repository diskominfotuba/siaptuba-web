<?php

namespace App\Http\Controllers\BKPP\Master;

use App\Http\Controllers\Controller;
use App\Models\BkppKategoriLayanan;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    public $kategori;
    public function __construct(BkppKategoriLayanan $BkppKategori)
    {
        $this->kategori = new BaseService($BkppKategori);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data['table'] = $this->kategori->Query()->paginate(10);
            return view('bkpp.master.kategori._data_kategori', $data);
        }
        return view('bkpp.master.kategori.index');
    }

    public function store()
    {
        $validator = Validator::make(\request()->all(), [
            'nama_kategori'  => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors());
        }

        $data = \request()->except('_token');
        $data['slug'] = Str::slug($data['nama_kategori']);
        try {
            $this->kategori->store($data);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
        return $this->success($data, 'Data berhasil ditambahkan');
    }

    public function update(Request $request)
    {
        $validator = Validator::make(\request()->all(), [
            'nama_kategori'  => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors());
        }

        $data = \request()->except('_token');
        $data['slug'] = Str::slug($data['nama_kategori']);

        $kategori = $this->kategori->find($request->id);
        try {
            $this->kategori->update($kategori, $data);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
        return $this->success($data, 'Data berhasil ditambahkan');
    }

    public function destroy(Request $request)
    {
        try {
            $this->kategori->delete($request->id);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
        return $this->success('Data berhasil dihapus');
    }
}
