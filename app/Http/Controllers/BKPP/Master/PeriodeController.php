<?php

namespace App\Http\Controllers\BKPP\Master;

use App\Http\Controllers\Controller;
use App\Models\BkppInputLayanan;
use App\Models\BkppKategoriLayanan;
use App\Models\BkppLayanan;
use App\Models\BkppPeriode;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PeriodeController extends Controller
{
    public $layanan;
    public $input;
    public $periode;
    public $kategori;
    public function __construct(BkppPeriode $bkppPeriode, BkppLayanan $bkppLayanan, BkppInputLayanan $bkppInputLayanan, BkppKategoriLayanan $bkppKategoriLayanan)
    {
        $this->periode = new BaseService($bkppPeriode);
        $this->layanan = new BaseService($bkppLayanan);
        $this->input = new BaseService($bkppInputLayanan);
        $this->kategori = new BaseService($bkppKategoriLayanan);
    }

    public function index(Request $request, $kategori_id, $layanan_id)
    {
        if ($request->ajax()) {
            $data['table'] = $this->periode->Query()->where('layanan_id', $layanan_id)->paginate(10);
            return view('bkpp.master.periode._data_periode', $data);
        }
        $layanan = $this->layanan->Query()->with('kategori')->where('id', $layanan_id)->first();
        return view('bkpp.master.periode.index', compact('layanan'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make(\request()->all(), [
            'nama_periode'  => 'required|string',
            'mulai'  => 'required|date',
            'berakhir'  => 'required|date',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors());
        }

        $data = \request()->except('_token');
        $data['layanan_id'] = $request->layanan_id;

        try {
            $this->periode->store($data);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
        return $this->success($data, 'Data berhasil ditambahkan');
    }

    public function update(Request $request)
    {
        $validator = Validator::make(\request()->all(), [
            'nama_periode'  => 'required|string',
            'mulai'  => 'required|date',
            'berakhir'  => 'required|date',
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors());
        }

        $data = \request()->except('_token');
        $data['layanan_id'] = $request->layanan_id;

        $periode = $this->periode->find($request->id);
        try {
            $this->periode->update($periode, $data);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
        return $this->success($data, 'Data berhasil diperbarui');
    }

    public function destroy(Request $request)
    {
        try {
            $this->periode->delete($request->id);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
        return $this->success('Data berhasil dihapus');
    }
}
