<?php

namespace App\Http\Controllers\BKPP;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\BkppService;
use App\Models\BkppPengajuan;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public $pengajuan;
    public function __construct(BkppPengajuan $pengajuan) {
        $this->pengajuan = new BkppService($pengajuan);
    }

    public function __invoke(Request $request)
    {
        if($request->ajax()) {
            dd('ok');
        }
        $data['title'] = "Layanan kepegawaian";
        $data['pangkat_reguler'] = $this->pengajuan->Query()->where('id_katpengajuan', '1')->count();
        $data['pangkat_fungsional'] = $this->pengajuan->Query()->where('id_katpengajuan', '2')->count();
        $data['pangkat_struktural'] = $this->pengajuan->Query()->where('id_katpengajuan', '3')->count();
        $data['pencantuman_gelar'] = $this->pengajuan->Query()->where('id_katpengajuan', '4')->count();
        $data['penyesuaian_ijasah'] = $this->pengajuan->Query()->where('id_katpengajuan', '5')->count();
        $data['mutasi_masuk'] = $this->pengajuan->Query()->where('id_katpengajuan', '6')->count();
        $data['mutasi_keluar'] = $this->pengajuan->Query()->where('id_katpengajuan', '7')->count();
        $data['mutasi_dalam'] = $this->pengajuan->Query()->where('id_katpengajuan', '8')->count();
        $data['karis_karsu'] = $this->pengajuan->Query()->where('id_katpengajuan', '9')->count();
        return view('bkpp.dashboard.index', $data);
    }
}
