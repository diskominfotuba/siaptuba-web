<?php

use App\Models\Kegiatan;
use App\Models\KunjunganMedia;
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
        Schema::create('kunjungan_media', function (Blueprint $table) {
            $table->id();
            $table->uuid('media_id');
            $table->uuid('kegiatan_id');
            $table->string('tandatangan')->nullable();
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
        Schema::dropIfExists('kunjungan_media');
    }
};
