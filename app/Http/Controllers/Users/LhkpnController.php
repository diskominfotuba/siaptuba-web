<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Imports\LhkpnImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\Lhkpn;

class LhkpnController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
           $data['table'] = Lhkpn::get();
           return view('users.lhkpn._data_table', $data);
        }
        
        $data['title'] = "LHKPN";
        $data['lhkpn'] = Lhkpn::inRandomOrder()->get();
        return view('users.lhkpn.index', $data);
    }
}
