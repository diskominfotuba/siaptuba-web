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
        Schema::dropIfExists('bkpp_pengajuans');

        Schema::create('bkpp_pengajuans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->index()->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('layanan_id')->index()->references('id')->on('bkpp_layanans')->onDelete('cascade');
            $table->foreignId('periode_id')->nullable()->references('id')->on('bkpp_periodes')->onDelete('set null');
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
