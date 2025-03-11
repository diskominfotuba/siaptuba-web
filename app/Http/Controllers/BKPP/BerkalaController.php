<?php

namespace App\Http\Controllers\BKPP;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dokumen;
use App\Services\BaseService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
class BerkalaController extends Controller
{
    protected $dokumen;
    public function __construct(Dokumen $dokumen)
    {
        $this->dokumen = new BaseService($dokumen);
    }

    public function index(Request $request)
    {
        if($request->ajax()) {
           $data['table'] = $this->dokumen->Query()->where('kategori_dokumen', 'berkala')
           ->with('user')
           ->paginate();
           return view('bkpp.berkala._data_table', $data);
        }

        $data['title'] = "Kenaikan gaji berkala";
        return view('bkpp.berkala.index', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->only('user_id', 'file_berkala'),
            [
                'user_id' => 'required',
                'file_berkala'  => 'required|mimes:pdf|max:2045'
            ],
            [
                'user_id.required' => 'Silakan pilih user terlebih dahulu',
                'file_berkala.required' => 'File berkala harus dipilih',
                'file_berkala.mimes' => 'File berkala harus berformat pdf',
                'file_berkala.max' => 'File berkala maksimal 2MB'
            ]
        );

        if ($validator->fails()) {
            return $this->error($validator->errors());
        }

        $fileName = time() . '-' . str_replace(' ', '-', 'file-berkala') . '.pdf';
        $pathFile = 'dokumen_kepegawaian/berkala';
        $request->file('file_berkala')->storeAs($pathFile, $fileName, 's3');

        $data['user_id'] = $request->user_id;
        $data['kategori_dokumen'] = "berkala";                          
        $data['nama_file'] = "Kenaikan Gaji Berkala (KGB)";
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
        $dokumen = $this->dokumen->find($id);
        Storage::disk('s3')->delete('dokumen_kepegawaian/berkala/'. $dokumen->file);
        $dokumen->delete($id);
        return $this->success(null, 'File berhasil dihapus');
    }
}
