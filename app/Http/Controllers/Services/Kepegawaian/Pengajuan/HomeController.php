<?php

namespace App\Http\Controllers\Services\Kepegawaian\Pengajuan;

use App\Http\Controllers\Controller;
use App\Models\BkppKategoriLayanan;
use App\Services\BaseService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public $kategori_layanan;
    public function __construct(BkppKategoriLayanan $BkppKategoriLayanan)
    {
        $this->kategori_layanan = new BaseService($BkppKategoriLayanan);
    }

    public function __invoke(Request $request)
    {
        if ($request->ajax()) {
            $data['table'] = $this->kategori_layanan->Query()->with('layanan')->get();
            return view('services.kepegawaian.pengajuan.home._data_kategori_layanan', $data);
        }
        $data['title'] = "Kategori Layanan Kepegawaian";
        return view('services.kepegawaian.pengajuan.home.index', $data);
    }
}
