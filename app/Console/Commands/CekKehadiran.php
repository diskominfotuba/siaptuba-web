<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\KehadiranService;
use Illuminate\Support\Facades\Log;

class CekKehadiran extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'presensi:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::info('Menjalankan command presensi:check');

        $presensiService = new KehadiranService();
        $presensiService->cronCheckAbsence();

        $this->info('Absence check completed.');
        Log::info('Command presensi:check selesai dijalankan');
        return 0;
    }
}
