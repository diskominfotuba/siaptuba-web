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
        Schema::create('bkpp_berkas_pengajuans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('pengajuan_id');
            $table->foreignId('input_layanan_id')->index()->references('id')->on('bkpp_input_layanans')->onDelete('cascade');
            $table->foreignUuid('dokumen_id');
            $table->foreignId('periode_id')->nullable()->references('id')->on('bkpp_periodes')->onDelete('set null');
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
        Schema::dropIfExists('bkpp_berkas_pengajuans');
    }
};
