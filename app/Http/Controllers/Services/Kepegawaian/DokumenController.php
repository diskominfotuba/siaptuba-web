<?php

namespace App\Http\Controllers\Services\Kepegawaian;

use App\Http\Controllers\Controller;
use App\Models\BkppBerkasPengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Dokumen;
use App\Services\BaseService;
use Illuminate\Support\Facades\Storage;

class DokumenController extends Controller
{
    protected $dokumen;
    protected $berkasPengajuan;
    public function __construct(Dokumen $dokumen, BkppBerkasPengajuan $bkppBerkasPengajuan)
    {
        $this->dokumen = new BaseService($dokumen);
        $this->berkasPengajuan = new BaseService($bkppBerkasPengajuan);
    }

    public function index(Request $request)
    {
        $dokumen = $this->dokumen->Query();
        if ($request->ajax()) {
            if($request->input('kategori_dokumen')) {
                $dokumen->where('kategori_dokumen', $request->input('kategori_dokumen'));
            }

            $data['table'] = $dokumen->where('user_id', Auth::id())->latest()->get();
            return view('services.kepegawaian.dokumen._data_dokumen', $data);
        }

        $data['title'] = "Dokumen Kepegawaian";
        return view('services.kepegawaian.dokumen.index', $data);
    }

    public function create(Request $request)
    {
        if ($request->ajax()) {
            $data['table'] = $this->dokumen->Query()->where('user_id', Auth::id())->latest()->get();
            return view('services.kepegawaian.dokumen._data_dokumen', $data);
        }

        $data['title'] = "Dokumen Kepegawaian";
        return view('services.kepegawaian.dokumen.index', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->only('nama_file', 'file'),
            [
                'nama_file' => 'required',
                'file'  => 'required|mimes:pdf|max:1045'
            ],
            [
                'nama_file.required' => 'Nama file harus diisi',
                'file.required' => 'File harus diisi',
                'file.mimes' => 'File harus berformat pdf',
                'file.max' => 'File maksimal 1MB'
            ]
        );

        if ($validator->fails()) {
            return $this->error($validator->errors());
        }

        $fileName = time() . '-' . str_replace(' ', '-', $request->nama_file) . '.pdf';
        $pathFile = 'dokumen_kepegawaian/' . Auth::id();
        $request->file('file')->storeAs($pathFile, $fileName, 's3');

        $data['user_id'] = Auth::id();
        $data['nama_file'] = $request->nama_file;
        $data['file'] = $fileName;

        try {
            $this->dokumen->store($data);
        } catch (\Throwable $th) {
            return $this->warning($th->getMessage());
        }

        return $this->success(null, 'File berhasil diupload');
    }

    public function delete($id)
    {
        $berkas = $this->berkasPengajuan->Query()->where('dokumen_id', $id)->first();
        if ($berkas) {
            return $this->error('Dokumen telah digunakan dalam pengajuan');
        }
        $dokumen = $this->dokumen->find($id);
        Storage::disk('s3')->delete('dokumen_kepegawaian/' . Auth::id() . '/' . $dokumen->file);
        $dokumen->delete($id);
        return $this->success(null, 'File berhasil dihapus');
    }
}
