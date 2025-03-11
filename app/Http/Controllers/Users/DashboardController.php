<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Izin;
use App\Models\Persensi;
use App\Models\User;
use App\Models\Tpp;
use App\Models\Lhkpn;
use App\Services\PresensiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public $presensi;
    public function __construct(PresensiService $presensiService)
    {
        $this->presensi = $presensiService;
    }

    public function __invoke(Request $request)
    {
        $user = Auth::user();
        if (request()->ajax()) {
            $yesterday = Carbon::yesterday();
            if (!$yesterday->isWeekend()) {
                //cek apakah kemaren user mengisi presensi pulang/tidak
                $presensi = $this->presensi->Query()->where('user_id', $user->id)->latest()->skip(1)->first();

                //jika user tidak melakukan presensi, kurangi tpp sesuai dengan perbub
                if ($presensi && $presensi->jam_pulang === null) {
                    //cek tpp berjalan
                    $tpp_saat_ini = Tpp::where('user_id', $user->id)
                        ->whereYear('created_at', Carbon::now()->year)
                        ->whereMonth('created_at', Carbon::now()->month)
                        ->latest()
                        ->first();

                    DB::beginTransaction();
                    try {
                        //update presensi kemaren
                        $presensi->update([
                            'jam_pulang'    => '-',
                            'status_pulang' => 'tdk presensi pulang',
                        ]);

                        //penguran tpp
                        $pengurangan_tpp = 0.6 / 100 *  $user->tpp;
                        if ($tpp_saat_ini) {
                            $tpp_hasil_pengurangan = $tpp_saat_ini->tpp_berjalan - $pengurangan_tpp;
                            Tpp::create([
                                'user_id'       => $user->id,
                                'tpp_berjalan'  => $tpp_hasil_pengurangan,
                                'jumlah_menit'  => 'tdk presensi pulang',
                                'pengurangan'   => $pengurangan_tpp,
                                'created_at'    => Carbon::parse($presensi->created_at)->addMinute()
                            ]);
                        } else {
                            $tpp_hasil_pengurangan = $user->tpp - $pengurangan_tpp;
                            Tpp::create([
                                'user_id'       => $user->id,
                                'tpp_berjalan'  => $tpp_hasil_pengurangan,
                                'jumlah_menit'  => 'tdk presensi pulang',
                                'pengurangan'   => $pengurangan_tpp,
                                'created_at'    => Carbon::parse($presensi->created_at)->addMinute()
                            ]);
                        }
                        //akhir pengurangan tpp
                    } catch (\Throwable $th) {
                        //throw $th;
                        Log::info("Gagal update presensi kemaren!");
                        DB::rollback();
                    }
                    DB::commit();
                }
            };

            $minutes = 720;
            if (request()->bulan) {
                $presensi = $this->presensi->Query();
                $presensi->whereYear('created_at', now()->format('Y'));
                $presensi->whereMonth('created_at', request()->bulan);
                $data['table'] =  $presensi->where('user_id', auth()->user()->id)->latest()->limit(5)->get();
                return view('users.dashboard._data_table_absensi', $data);
            }

            $data['table'] = Cache::remember('table_dashboard_' . $user->id, $minutes, function () use ($user) {
                return Persensi::where('user_id', $user->id)->latest()->limit(5)->get();
            });

            return view('users.dashboard._data_table_absensi', $data);
        }

        //save cache
        $minutes = 720;

        $data['absen'] = Cache::remember('absen_' . $user->id, $minutes, function () use ($user){
            return Persensi::where('user_id', $user->id)->whereYear('created_at', now()->format('Y'))->whereMonth('created_at', Carbon::now()->month)->first();
        });
        $data['cuti'] = Cache::remember('cuti_' . $user->id, $minutes, function () use ($user) {
            return Persensi::where('user_id', $user->id)->where('status', 'cuti')->count();
        });
        $data['hadir'] = Cache::remember('hadir_' . $user->id, $minutes, function () use ($user) {
            return Persensi::where('user_id', $user->id)->whereYear('created_at', now()->format('Y'))->whereMonth('created_at', Carbon::now()->month)->count();
        });
        $data['terlambat'] = Cache::remember('terlambat_' . $user->id, $minutes, function () use ($user) {
            return $this->presensi->Query()->where('user_id', $user->id)->whereYear('created_at', now()->format('Y'))->whereMonth('created_at', Carbon::now()->month)->where('status', 'like', '%' . 'Terlambat' . '%')->count();
        });
        $data['dl'] = Cache::remember('dl_' . $user->id, $minutes, function () use ($user) {
            return Persensi::where('user_id', $user->id)->where('status', 'Dinas Luar (DL)')->count();
        });

        $presensi = Persensi::where('user_id', $user->id)
            ->whereDate('created_at', Carbon::now())
            ->first();

        if ($presensi && $presensi->status !== 'Dinas Luar (DL)' && $presensi->jam_pulang == null) {
            $jam_masuk = Carbon::parse($presensi->jam_masuk);
            $batas_jam_masuk = Carbon::parse(env('JAM_MASUK'));

            if ($jam_masuk > $batas_jam_masuk) {
                $selisih = $jam_masuk->diffInMinutes($batas_jam_masuk);
                $data['jam_ganti'] = $selisih > 30 ? 30 : $selisih;
            }
        }

        $tpp_user = Tpp::where('user_id', $user->id)->whereYear('created_at', now()->format('Y'))->whereMonth('created_at', Carbon::now()->month)->latest()->first();
        $data['tpp_akhir'] = $tpp_user->tpp_berjalan ?? $user->tpp;
        $data['lhkpn'] = Lhkpn::inRandomOrder()->get();
        return view('users.dashboard.index', $data);
    }
}


