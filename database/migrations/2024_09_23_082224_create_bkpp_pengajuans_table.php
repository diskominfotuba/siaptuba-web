<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bkpp_pengajuans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('id_katpengajuan');
            $table->string('id_bidang');
            $table->uuid('id_user');
            $table->string('status')->enum(['pending','diproses','diterima','ditolak', 'selesai']);
            $table->text('pesan')->nullable();
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bkpp_pengajuans');
    }
};
