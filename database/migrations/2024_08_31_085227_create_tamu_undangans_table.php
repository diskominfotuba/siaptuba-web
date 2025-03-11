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
        Schema::create('tamu_undangans', function (Blueprint $table) {
            $table->id();
            $table->uuid('kegiatan_id');
            $table->uuid('opd_id');
            $table->uuid('user_id');
            $table->string('tandatangan');
            $table->string('latlong')->nullable();
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
        Schema::dropIfExists('tamu_undangans');
    }
};
