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
        Schema::create('tpps', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id');
            $table->string('tpp_berjalan');
            $table->string('jumlah_menit');
            $table->string('pengurangan');
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
        Schema::dropIfExists('tpps');
    }
};
