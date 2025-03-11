<?php

namespace App\Http\Controllers\Oprator;

use Carbon\Carbon;
use App\Services\OpdService;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Exports\RekappresensiExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class RekappresensiController extends Controller
{
    protected $user;
    protected $opd;
    public function __construct(UserService $userService, OpdService $opdService)
    {
        $this->user = $userService;
        $this->opd = $opdService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $status = \request('status', 'asn');

            if ($request->tanggal_awal && $request->tanggal_akhir) {
                $tgl_awal = Carbon::parse($request->tanggal_awal)->toDateTimeString();
                $tgl_akhir = Carbon::parse($request->tanggal_akhir)->addDays(1)->toDateTimeString();
            } else {
                $tgl_awal = Carbon::now()->startOfMonth()->toDateTimeString();
                $tgl_akhir = Carbon::now()->endOfMonth()->toDateTimeString();
            }

            $data['table'] = User::where('opd_id', Auth::user()->opd_id)
                ->where('status_pegawai', $status)
                ->select('id', 'nama', 'status_pegawai', 'opd_id')
                ->with('opd')
                ->withCount([
                    'persensi' => function ($query) use ($tgl_awal, $tgl_akhir) {
                        $query->whereBetween('created_at', [$tgl_awal, $tgl_akhir])
                            ->where('status', '!=', 'Tidak Presensi');
                    }
                ])
                ->orderBy('persensi_count', 'desc')
                ->get();

            $data['tgl_awal'] = $tgl_awal;
            $data['tgl_akhir'] = $tgl_akhir;
            return view('oprator.rekappresensi._data_presensi_opd', $data);
        }

        $data['title'] = 'Laporan presensi pegawai';
        return view('oprator.rekappresensi.index', $data);
    }

    public function export(Request $request)
    {
        $status = \request('status', 'non_asn');
        if ($request->tanggal_awal && $request->tanggal_akhir) {
            $tgl_awal = Carbon::parse($request->tanggal_awal)->toDateTimeString();
            $tgl_akhir = Carbon::parse($request->tanggal_akhir)->addDays(1)->toDateTimeString();
        } else {
            $tgl_awal = Carbon::now()->startOfMonth()->toDateTimeString();
            $tgl_akhir = Carbon::now()->endOfMonth()->toDateTimeString();
        }

        $users = User::where('opd_id', Auth::user()->opd_id)
            ->where('status_pegawai', $status)
            ->select('id', 'nama', 'status_pegawai', 'opd_id')
            ->with('opd')
            ->withCount([
                'persensi' => function ($query) use ($tgl_awal, $tgl_akhir) {
                    $query->whereBetween('created_at', [$tgl_awal, $tgl_akhir])
                        ->where('status', '!=', 'Tidak Presensi');
                }
            ])
            ->orderBy('persensi_count', 'desc')
            ->get();

        return Excel::download(new RekappresensiExport($users), 'rekapitulasi_presensi_' . time() . '.xlsx');
    }
}
