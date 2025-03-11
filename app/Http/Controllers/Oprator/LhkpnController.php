<?php

namespace App\Http\Controllers\Oprator;

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
        if(Auth::user()->opd_id !== 44) {
            return \abort(404);
        }

        if($request->ajax()) {
            //gunakan ini jika fitur pencarian sangat jarang digunakan
            if(\request()->search) {
                $data['table'] = Lhkpn::where('td_1', 'like', '%' . \request()->search . '%')->paginate();
                return view('oprator.lhkpn._data_tabel', $data);
            }

           $data['table'] = Lhkpn::paginate(10);
           return view('oprator.lhkpn._data_tabel', $data);

        //    $table = Lhkpn::when(request()->search, function($query, $search) {
        //     return $query->where('td_1', 'like', '%' . $search . '%');
        //     })->paginate();
        
        //    return view('oprator.lhkpn._data_tabel', compact('table'));
        
        }
        
        $data['title'] = "LHKPN";
        return view('oprator.lhkpn.index', $data);
    }

    public function update(Request $request, $id) {
        if(Auth::user()->opd_id !== 44) {
            return \abort(404);
        }
        
        $validator = Validator::make($request->all(), [
            'td_1' => 'required',
            'td_2' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors());
        }
        
        $lhkpn = Lhkpn::find($id);
        $lhkpn->update([
            'td_1'  => $request->td_1,
            'td_2'  => $request->td_2,
            'td_3'  => $request->td_3,
        ]);
        return $this->success('OK', 'Data berhasil diupdate');
    }

    public function import(Request $request)
    {
        if(Auth::user()->opd_id !== 44) {
            return \abort(404);
        }

        $validator = Validator::make($request->all(), [
            'file_lhkpn' => 'required|mimes:csv,xls,xlsx'
        ]);

        if ($validator->fails()) {
            return $this->error($validator->errors());
        }

        Excel::import(new LhkpnImport(), $request->file('file_lhkpn'));

        return $this->success('OK', 'Data LHKPN berhasil ditambahkan');
    }

    public function delete($id)
    {
        if(Auth::user()->opd_id !== 44) {
            return \abort(404);
        }
        
        $lhkpn = Lhkpn::find($id);
        $lhkpn->delete($id);
        return $this->success('OK', 'Data berhasil dihapus');
    }

    public function deleteAllData()
    {
        if(Auth::user()->opd_id !== 44) {
            return \abort(404);
        }
        
        Lhkpn::truncate();
        return $this->success('OK', 'Data berhasil dihapus');
    }
}
