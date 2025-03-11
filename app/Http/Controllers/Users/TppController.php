<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\BaseService;
use App\Models\Tpp;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TppController extends Controller
{
    protected $tpp;
    public function __construct(Tpp $tpp) {
        $this->tpp = new BaseService($tpp);
    }

    public function index(Request $request)
    {
        if($request->ajax()) {
            $data['table'] = $this->tpp->Query()->where('user_id', Auth::user()->id)->latest()->limit(5)->get();
            $data['title'] = 'Riwayat pengurangan tambahan penghasilan pegawai';
            return view('users.tpp._data_tpp', $data);
        }

        $data['title'] = "Riwayat pengurangan tambahan penghasilan pegawai";
        return view('users.tpp.index', $data);
    }

    public function riwayat(Request $request)
    {
        if($request->ajax()) {
            $tpp = $this->tpp->Query();
            $data['table'] = $tpp->where('user_id', Auth::user()->id)->whereMonth('created_at', Carbon::now()->month)->latest()->limit(5)->get();
            $data['title'] = 'Riwayat pengurangan tambahan penghasilan pegawai';
            return view('users.tpp._data_tpp', $data);
        }
    }

}
