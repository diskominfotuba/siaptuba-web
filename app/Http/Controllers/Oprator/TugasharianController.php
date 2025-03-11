<?php

namespace App\Http\Controllers\Oprator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kinerja;
use App\Models\User;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;

class TugasharianController extends Controller
{
    protected $kinerja;
    public function __construct(Kinerja $kinerja) {
        $this->kinerja = new BaseService($kinerja);
    }

    public function index(Request $request) 
    {
        if($request->ajax()) {
            
            $user = Auth::user();
            $paginate = \request()->get('paginate', 10);
            $kinerja = $this->kinerja->Query()
            ->whereYear('created_at', now()->format('Y'))
            ->where('opd_id', $user->opd_id);

            if(\request()->search) {
                $kinerja->whereHas('user', function($query) {
                    $query->where('nama', 'like', '%' . \request()->search . '%');
                });
            }

            if(\request()->bulan) {
                $kinerja->whereMonth('created_at', \request()->bulan);
            }

            $data['table'] = $kinerja->paginate($paginate);
            return view('oprator.tugasharian._data_table', $data);
        }
        $data['title'] = 'Tugas harian pegawai';
        return view('oprator.tugasharian.index', $data);
    }

    public function printAll(Request $request)
    {
       $data['title'] = 'Print out tugas harian pegawai';
       $data['table'] = $this->kinerja->Query()
       ->whereYear('created_at', now()->format('Y'))
       ->whereMonth('created_at', $request->bulan)
       ->where('opd_id', Auth::user()->opd_id)->get();
       return view('oprator.tugasharian.printall', $data);
    }

    public function show(Request $request, $id)
    {
        if($request->ajax()) {
            $kinerja = $this->kinerja->Query()->where('user_id', $id);

            if(\request()->bulan) {
                $kinerja->whereMonth('created_at', \request()->bulan);
            }
            $data['table']  = $kinerja->paginate();
            return view('oprator.tugasharian._data_table', $data);
        }

        $data['title']    = 'Detail tugas harian pegawai';
        $data['user']     = User::find($id);

        return view('oprator.tugasharian.show', $data);
    }

    public function destroy($id)
    {
        $kinerja = $this->kinerja->find($id);
        if(!$kinerja) {
            return $this->error('Data kinerja tidak ditemukan!');
        }else {
            $kinerja->delete();
            Storage::disk('s3')->delete('ekin/' . $kinerja->opd_id . '/' . $kinerja->created_at->format('Y') . '/' . $kinerja->bukti_dukung);
            return $this->success('OK', 'Data kinerja berhasil dihapus');
        }
    }
}
