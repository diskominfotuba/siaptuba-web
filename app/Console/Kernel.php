<?php

namespace App\Console;

use App\Services\KehadiranService as ServicesKehadiranService;
use App\Services\DLService;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use KehadiranService;
use App\Http\Controllers\Cronjob\Cuti;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // // cron kehadiran - dijalankan setiap malam pukul 22:00
        $schedule->call(function () {
            $presensiService = new ServicesKehadiranService();
            $presensiService->cronCheckAbsence();
        })->weekdays()->at('22:00');

        // cron cek dl status pending yang sudah melebihi batas waktu 3 hari - dijalankan setiap malam pukul 23:30
        $schedule->call(function () {
            $dlService = new DLService();
            $dlService->CronCheckCekDl();
        })->daily()->at('22:30');

        // cron cek dl status pending yang sudah melebihi batas waktu 3 hari - dijalankan setiap malam pukul 23:30
        $schedule->call(function () {
            $cuti = new Cuti();
            $cuti->CronCheckCuti();
        })->daily()->at('23:00');

        // // cron clean backup - dijalankan setiap malam pukul 00:00
        $schedule->command('backup:clean')->daily()->at('00:00');

        // // cron backup database - dijalankan setiap malam pukul 00:30
        $schedule->command('backup:run --only-db')->daily()->at('00:30');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
