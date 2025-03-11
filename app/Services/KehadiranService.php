<?php

namespace App\Services;

use App\Models\Cuty;
use App\Models\Izin;
use App\Models\Persensi;
use App\Models\User;
use App\Models\Tpp;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class KehadiranService
{
    public function cekPresensiByUser($userId, $date)
    {
        // Ambil informasi user berdasarkan userId
        $user = User::find($userId);

        if (!$user) {
            return;
        }

        // Ambil OPD ID dari user
        $opdId = $user->opd_id;

        // Hitung jumlah user di OPD
        $userByOpdId = User::where('opd_id', $opdId)->count();

        // Hitung jumlah presensi pada tanggal tersebut berdasarkan opd_id
        $presensiDate = Persensi::where('opd_id', $opdId)
            ->where('tanggal', $date)
            ->count();

        // Cek apakah lebih dari 50% pegawai hadir
        if ($presensiDate <= $userByOpdId / 2) {
            Log::info("Kurang dari 50% pegawai hadir, hari dianggap libur");
            // Jika lebih dari 50% pegawai tidak hadir, tandai hari sebagai hari libur
            return;
        }

        // Cek apakah user tersebut presensi pada tanggal tersebut
        $presensiUserDate = Persensi::where('user_id', $userId)
            ->where('tanggal', $date)
            ->count();

        if ($presensiUserDate == 0) {
            // Cek apakah user sedang cuti atau tidak
            $cuti = Izin::where('user_id', $userId)->latest()->first();
            if ($cuti) {
                // Jika ada cuti cek apakah tanggal masuk sudah lewat/belum
                $tanggalMasukCuti = Carbon::createFromDate($cuti->tanggal_masuk);
                // Periksa apakah tanggal tersebut sudah lewat dari hari ini
                if ($tanggalMasukCuti->isPast()) {
                    $this->markAbsent($userId, $opdId, $date, $user->nama, $user->tpp);
                } else {
                    Log::info("User ID: $user->nama sedang cuti dan tanggal masuk belum lewat");
                }
            } else {
                // User tidak sedang cuti
                $this->markAbsent($userId, $opdId, $date, $user->nama, $user->tpp);
            }
        }
    }

    // Fungsi untuk menandai user tidak masuk
    private function markAbsent($userId, $opdId, $date, $nama, $tpp)
    {
        $data = [
            'opd_id' => $opdId,
            'user_id' => $userId,
            'tanggal' => $date,
            'jam_masuk' => '0',
            'jam_pulang'    => '0',
            'lat_long_masuk'    => '0',
            'lat_long_pulang'   => '0',
            'photo_masuk'       => "no_image.png",
            'status'            => 'Tidak Presensi',
        ];

        DB::beginTransaction();
        try {
            Persensi::create($data);

            //cek tpp berjalan
            $tpp_saat_ini = Tpp::where('user_id', $userId)
                ->whereMonth('created_at', Carbon::now()->month) // bulan saat ini
                ->latest()
                ->first();

            //penguran tpp
            $pengurangan_tpp = 0.6 / 100 *  $tpp;
            if ($tpp_saat_ini) {
                $tpp_hasil_pengurangan = $tpp_saat_ini->tpp_berjalan - $pengurangan_tpp;
                Tpp::create([
                    'user_id'   => $userId,
                    'tpp_berjalan' => $tpp_hasil_pengurangan,
                    'jumlah_menit' => 'tdk hadir (1.5)',
                    'pengurangan'   => $pengurangan_tpp
                ]);
            } else {
                $tpp_hasil_pengurangan = $tpp - $pengurangan_tpp;
                Tpp::create([
                    'user_id'   => $userId,
                    'tpp_berjalan' => $tpp_hasil_pengurangan,
                    'jumlah_menit' => 'tdk hadir (1.5)',
                    'pengurangan'   => $pengurangan_tpp
                ]);
            }
            //akhir pengurangan tpp

            Log::info("Data presensi user: $nama berhasil disimpan");
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error("Gagal menyimpan data presensi user ID: $userId", ['exception' => $th]);
            telegramNotification("Gagal menyimpan data presensi user ID:",  $userId);
            throw $th;
        }
        DB::commit();
    }

    // Fungsi untuk cronjob memeriksa ketidakhadiran pegawai secara berkala
    public function cronCheckAbsence()
	{
	    // Ambil semua user dari database
	    // $users = User::all();
        $users = User::where('opd_id', '!=', 49)->get();

        // Ambil tanggal hari ini
        $today = Carbon::now()->format('Y-m-d');

        // Loop melalui setiap user
        foreach ($users as $user) {
            $this->cekPresensiByUser($user->id, $today);
        }
    }
}
