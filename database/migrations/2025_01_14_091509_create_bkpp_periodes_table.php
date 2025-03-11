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
        Schema::create('bkpp_periodes', function (Blueprint $table) {
            $table->id();
            $table->string('nama_periode');
            $table->date('mulai');
            $table->date('berakhir');
            $table->foreignId('layanan_id')->references('id')->on('bkpp_layanans')->onDelete('cascade');
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
        Schema::dropIfExists('bkpp_periodes');
    }
};
