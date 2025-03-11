<?php

namespace App\Http\Controllers\Services\Kepegawaian;

use App\Http\Controllers\Controller;
use App\Models\Dokumen;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public $dokumen;
    public function __construct(Dokumen $dokumen)
    {
        $this->dokumen = new BaseService($dokumen);
    }

    public function index()
    {
        $data['title'] = 'Pengajuan';
        return view("services.kepegawaian.pengajuan.index", $data);
    }

    public function kenaikanPangkat()
    {
        $data['title'] = 'Pengajuan/Kenaikan Pangkat';
        return view("services.kepegawaian.pengajuan.kenaikan_pangkat", $data);
    }

    public function mutasi()
    {
        $data['title'] = 'Pengajuan/Mutasi';
        return view("services.kepegawaian.pengajuan.mutasi", $data);
    }

    public function dokumen()
    {
        $dokumen = $this->dokumen->Query()->where('user_id', Auth::id())->latest();
        if (\request()->search) {
            $dokumen->where('nama_file', 'like', '%' . \request()->search . '%');
        }
        $data['table'] = $dokumen->paginate(5);
        return view('services.kepegawaian.pengajuan._data_dokumen', $data);
    }
}
