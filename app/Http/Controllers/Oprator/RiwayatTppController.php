<?php

namespace App\Http\Controllers\Oprator;

use App\Http\Controllers\Controller;
use App\Models\Tpp;
use App\Models\User;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RiwayatTppController extends Controller
{
    protected $tpp;
    protected $user;
    public function __construct(Tpp $tpp, User $user)
    {
        $this->tpp = new BaseService($tpp);
        $this->user = new BaseService($user);
    }

    public function index(Request $request)
    {
        $opdId = Auth::user()->opd_id;
        if ($request->ajax()) {
            $data['table'] = $this->user->Query()
            ->where('opd_id', $opdId)
            ->with(['tpps' => function($q) {
                $q->whereYear('created_at', Carbon::now()->year)
                ->whereMonth('created_at', \request()->bulan)
                ->latest();
            }])
            ->where('tpp', '!=', '0')
            ->select('id', 'nama', 'tpp')
            ->paginate();

            return view('oprator.riwayattpp._data_tpp', $data);
        }

        $data['title'] = 'Data Riwayat TPP';
        return view('oprator.riwayattpp.index', $data);
    }

    public function show(Request $request, $user_id)
    {
        if (\request()->ajax()) {
            $bulan = \request()->bulan ??  Carbon::now('m');
            $data['table'] = $this->tpp->Query()->where('user_id', $user_id)->whereMonth('created_at', $bulan)->latest()->get();
            
            $user = $this->user->find($user_id);
            $total_pengurangan = $this->tpp->Query()
            ->where('user_id', $user_id)
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', $bulan)
            ->sum('pengurangan');

            $data['total_pengurangan'] = $total_pengurangan;
            $data['estimasi_tpp_diterima'] = $user->tpp - $total_pengurangan;
            
            return view('oprator.riwayattpp._data_mutasi_tpp', $data);
        }

        $data['title'] = "Riwayat pengurangan TPP";
        $data['user'] = $this->user->find($user_id);
        return view('oprator.riwayattpp.show', $data);
    }

    public function print(Request $request)
    {
        $user = $this->user->find(\request()->user_id);
        if (\request()->ajax()) {
            $bulan = $request->bulan ??  Carbon::now()->month;
            $total_pengurangan = $this->tpp->Query()->where('user_id', $user->id)->whereMonth('created_at', $bulan)->sum('pengurangan');
            
            $data['table'] = $this->tpp->Query()->where('user_id', $user->id)->whereMonth('created_at', $bulan)->latest()->get();
            $data['total_pengurangan']      = $total_pengurangan;
            $data['estimasi_tpp_diterima']  = $user->tpp - $total_pengurangan;
            return view('oprator.riwayattpp._data_mutasi_tpp', $data);
        }

        $data['title'] = "Riwayat pengurangan TPP";
        $data['user'] = $user;
        return view('oprator.riwayattpp.print', $data);
    }

    public function printAll(Request $request)
    {
        if (\request()->ajax()) {

            $opdId = Auth::user()->opd_id;
            $user_id = \request()->user_id;

            $data['table'] = $this->user->Query()
            ->where('opd_id', $opdId)
            ->with(['tpps' => function($q) {
                $q->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', \request()->bulan)->latest();
            }])
            ->where('tpp', '!=', '0')
            ->select('id', 'nama', 'tpp')
            ->get();

            return view('oprator.riwayattpp._data_tppall', $data);
        }
        $data['title'] = 'Pengurangan Tambahan Penghasilan Pegawai (TPP)';
        return view('oprator.riwayattpp.printall', $data);
    }
}
