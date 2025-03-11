<?php

namespace App\Http\Controllers\Services\Kepegawaian;

use App\Http\Controllers\Controller;
use App\Models\BkppPengajuan;
use App\Services\BkppService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public $pengajuan;
    public function __construct(BkppPengajuan $bkppPengajuan)
    {
        $this->pengajuan = new BkppService($bkppPengajuan);
    }

    public function __invoke(Request $request)
    {
        if ($request->ajax()) {
            $data['table'] = $this->pengajuan->Query()->with('layanan')->where('user_id', Auth::id())->get();
            return view('services.kepegawaian.home._data_pengajuan', $data);
        }
        $data['title'] = "Layanan kepegawaian";
        return view('services.kepegawaian.home.index', $data);
    }
}
