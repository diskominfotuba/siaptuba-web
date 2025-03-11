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
        Schema::create('survey_media', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id');
            $table->enum('status_pegawai', ['pns', 'non_pns']);
            $table->json('media');
            $table->enum('pernah_membaca', ['tidak', 'ya']);
            $table->enum('preferensi_membaca', ['digital', 'cetak']);
            $table->enum('sumber_berita', ['tidak', 'ya']);
            $table->enum('koran_digital', ['setuju', 'tidak']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('survey_media');
    }
};
