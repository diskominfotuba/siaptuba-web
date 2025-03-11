<?php

use App\Models\Log;
use App\Models\Tpp;
use App\Models\Modul;
use App\Models\Presensicount;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;


if (!function_exists('pengurangan_tpp')) {
    function pengurangan_tpp($keterlambatan) {
        
        //tpp pegawai
        $user = Auth::user();

        //cek tpp berjalan
        $tpp_saat_ini = Tpp::where('user_id', Auth::user()->id)
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month) // bulan saat ini
            ->latest()
            ->first();
        
        // rumus pengurangan tpp
        if($keterlambatan !== 0) {
            if ($keterlambatan >= 1 && $keterlambatan <= 30) {
                $pengurangan_tpp = 0.2 / 100 * $user->tpp; // 0.50% potongan
            } elseif ($keterlambatan >= 31 && $keterlambatan <= 60) {
                $pengurangan_tpp = 0.4 / 100 * $user->tpp; // 1% potongan
            } elseif ($keterlambatan >= 61 && $keterlambatan <= 90) {
                $pengurangan_tpp = 0.5 / 100 * $user->tpp; // 1.25% potongan
            } elseif ($keterlambatan >= 91 && $keterlambatan <= 120) {
                $pengurangan_tpp = 0.6 / 100 * $user->tpp; // 1.50% potongan
            }else {
                //tidak masuk kerja
                $pengurangan_tpp = 0.6 / 100 * $user->tpp;
            }

            // Kurangi total potongan dari TPP untuk mendapatkan TPP akhir setelah potongan
            if($tpp_saat_ini) {
                $tpp_hasil_pengurangan = $tpp_saat_ini->tpp_berjalan - $pengurangan_tpp;
                Tpp::create([
                    'user_id'       => $user->id,
                    'tpp_berjalan'  => $tpp_hasil_pengurangan,
                    'jumlah_menit'  => $keterlambatan . ' ' . 'menit',
                    'pengurangan'   => $pengurangan_tpp,
                ]); 
            }else {
                $tpp_hasil_pengurangan = $user->tpp - $pengurangan_tpp;
                Tpp::create([
                    'user_id'       => $user->id,
                    'tpp_berjalan'  => $tpp_hasil_pengurangan,
                    'jumlah_menit'  => $keterlambatan . ' ' . 'menit',
                    'pengurangan'   => $pengurangan_tpp
                ]);
            }
            //akhir rumus perhitungan
        }
    }
}

if (!function_exists('saveLogs')) {
    function saveLogs($description, $logType)
    {
        $dataLog = [
            'user_id' => Auth::user()->id,
            'log_description'   => Auth()->user()->nama  . ' ' . $description,
            'logtype'   => $logType,
        ];
        Log::create($dataLog);
    }
}

if (!function_exists('telegramNotification')) {
    function telegramNotification($status, $description)
    {
        $response = Http::post('https://api.telegram.org/bot6903681474:AAF3llrIatSkUcsKI5KIVAxziwqNrlvXvJk/sendMessage', [
            'chat_id'   => config('app.chat_id'),
            'text'    => $status . ', ' . $description,
        ]);
    }
}

if (!function_exists('formatRp')) {
    function formatRp($number)
    {
        return 'Rp ' . number_format($number, 0, ',', '.');
    }
}

if (!function_exists('Usercount')) {
    function Usercount()
    {
        $count_user = Presensicount::where('opd_id', Auth::user()->opd_id)->count();
        if ($count_user !== 0) {
            Presensicount::where('opd_id', Auth::user()->opd_id)->increment('total_user');
        } else {
            $datauser = [
                'opd_id' => Auth::user()->opd_id,
                'total_user' => 1,
                'total_presensi' => 0,
            ];
            Presensicount::create($datauser);
        }
    }
}

if (!function_exists('Presensicount')) {
    function Presensicount()
    {
        $presensiCount = Presensicount::where('opd_id', Auth::user()->opd_id)
            ->whereDate('updated_at', Carbon::now()->toDateString())
            ->count();

        if ($presensiCount !== 0) {
            Presensicount::where('opd_id', Auth::user()->opd_id)
                ->whereDate('updated_at', Carbon::now()->toDateString())
                ->increment('total_presensi');
        } else {
            Presensicount::where('opd_id', Auth::user()->opd_id)->update(['total_presensi' => 1]);
        }
    }
}

if (!function_exists('validationErrorResponse')) {
    function validationErrorResponse($errors, int $code = Response::HTTP_UNPROCESSABLE_ENTITY)
    {
        return response()->json([
            'success' => false,
            'message' => 'Terdapat validasi yang salah, Harap cek kembali!',
            'errors'  => $errors
        ], $code);
    }
}

if (!function_exists('canAccessModule')) {
    function canAccessModule($opdId, $moduleName)
    {
        $module = Modul::where('opd_id', $opdId)
            ->where('nama_module', $moduleName)
            ->where('status', 'active')
            ->first();

        return $module ? true : false;
    }
}
