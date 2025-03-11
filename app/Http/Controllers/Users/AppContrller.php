<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Persensi;
use App\Models\Approval;
use App\Models\Izin;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;
class AppContrller extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected $approval;
    protected $izin;
    public function __construct(Approval $approval, Izin $izin)
    {
        $this->approval = new BaseService($approval);
        $this->izin = new BaseService($izin);
    }

    public function __invoke(Request $request)
    {
        $data['title'] = "Apps";
        $data['izin_pending'] = $this->izin->Query()
        ->where('approval_status', 'pending')
        ->whereHas('user.approval', function ($query) {
            $query->where('approval_id', Auth::user()->id);
        })->with('user')->count();

        $data['dl_pending'] = Persensi::query()
        ->where('opd_id', Auth::user()->opd_id)
        ->where('status', 'Dinas Luar (DL)')
        ->where('approval_status', 'pending')
        ->whereHas('user.approval', function ($query) {
            $query->where('approval_id', Auth::id());
        })->with('user')->count();
        
        return view('apps.index', $data);
    }
}
