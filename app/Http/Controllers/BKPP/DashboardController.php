<?php

namespace App\Http\Controllers\BKPP;

use App\Http\Controllers\Controller;
use App\Models\BkppLayanan;
use Illuminate\Http\Request;
use App\Services\BaseService;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public $layanan;
    public function __construct(BkppLayanan $bkppLayanan)
    {
        $this->layanan = new BaseService($bkppLayanan);
    }

    public function __invoke(Request $request)
    {
        if ($request->ajax()) {
            $data['table'] = $this->layanan->query()
                ->withCount('pengajuan')
                ->get();
            return view('bkpp.dashboard._data_layanan', $data);
        }

        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $layanans = $this->layanan->query()
            ->withCount(['pengajuan' => function ($query) use ($currentMonth, $currentYear) {
                $query->whereMonth('created_at', $currentMonth)
                    ->whereYear('created_at', $currentYear)
                    ->whereIn('status', ['terverifikasi operator', 'pending', 'diproses', 'selesai', 'ditolak bkpp']);
            }])
            ->get();

        $namaLayanan = $layanans->pluck('nama_layanan')->toArray();
        $jumlahPengajuan = $layanans->pluck('pengajuan_count')->toArray();
        return view('bkpp.dashboard.index', compact('namaLayanan', 'jumlahPengajuan'));
    }
}
