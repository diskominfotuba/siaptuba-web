<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\DLService;
use Illuminate\Support\Facades\Log;

class CekDL extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dl:check';

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
        Log::channel('dinas_luar')->info('Menjalankan command dl:check');

        $presensiService = new DLService();
        $presensiService->CronCheckCekDl();

        $this->info('Dl check completed.');
        Log::channel('dinas_luar')->info('Command dl:check selesai dijalankan');
        return 0;
    }
}
