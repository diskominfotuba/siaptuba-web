<?php

namespace App\Services;

use App\Models\Persensi;
use App\Models\Tpp;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class DLService
{
    public function CronCheckCekDl()
    {
        //dapatkan tanggal 3 hari yang lalu ketika pungsi ini di jalankan
        //contoh jika hari ini tanggal 5, maka tiga hari yang lalu adalah tanggal 2
        $tiga_hari_berlalu = Carbon::now()->subDays(3);

        //buat blok dan jalanakan bulk update untuk setiap presensi status_approval pending yang sudah lewat dari 3 hari
        DB::beginTransaction();
        try {
            
            // Ambil data presensi yang akan diubah
            $presensiList = Persensi::where('approval_status', 'pending')
            ->whereYear('created_at', Carbon::now()->year)
            ->whereDate('created_at', '<', $tiga_hari_berlalu)
            ->get();

            // Ubah status approval menjadi 'ditolak'
            Persensi::where('approval_status', 'pending')
            ->whereYear('created_at', Carbon::now()->year)
            ->whereDate('created_at', '<', $tiga_hari_berlalu)
            ->update(['approval_status' => 'ditolak']);
                    
            foreach ($presensiList as $presensi) {
                $user = $presensi->user; // Relasi ke tabel user
        
                if ($user) {
                    // Ambil TPP saat ini untuk user
                    $tpp_saat_ini = Tpp::where('user_id', $user->id)
                        ->whereYear('created_at', Carbon::now()->year)
                        ->whereMonth('created_at', Carbon::now()->month)
                        ->latest()
                        ->first();
        
                    // Hitung pengurangan TPP
                    $pengurangan_tpp = 0.6 / 100 * $user->tpp; // 0.6% dari total TPP user
        
                    if ($tpp_saat_ini) {
                        $tpp_hasil_pengurangan = $tpp_saat_ini->tpp_berjalan - $pengurangan_tpp;
                        Tpp::create([
                            'user_id'       => $user->id,
                            'tpp_berjalan'  => $tpp_hasil_pengurangan,
                            'jumlah_menit'  => 'Presensi DL ditolak!', // Sesuaikan sesuai logika
                            'pengurangan'   => $pengurangan_tpp,
                            'keterangan'    => 'Presensi DL ditolak!',
                            'created_at'    => $presensi->created_at,
                        ]);
                    } else {
                        $tpp_hasil_pengurangan = $user->tpp - $pengurangan_tpp;
                        Tpp::create([
                            'user_id'       => $user->id,
                            'tpp_berjalan'  => $tpp_hasil_pengurangan,
                            'jumlah_menit'  => 'Presensi DL ditolak!',
                            'pengurangan'   => $pengurangan_tpp,
                            'keterangan'    => 'Presensi DL ditolak!',
                            'created_at'    => $presensi->created_at,
                        ]);
                    }
                }
            }
        
            Log::channel('dinas_luar')->info("Total " . $presensiList->count() . " presensi DL berhasil diupdate menjadi ditolak.");
            DB::commit();

        } catch (\Throwable $th) {

            DB::rollback();
            Log::channel('dinas_luar')->error("Gagal menyimpan data presensi DL", ['exception' => $th]);
            
        }
    }
}
