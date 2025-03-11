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
        Schema::create('bkpp_layanans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_layanan');
            $table->foreignId('kategori_id')->references('id')->on('bkpp_kategori_layanans')->onDelete('cascade');
            $table->text('slug');
            $table->boolean('punya_periode')->default(false);
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
        Schema::dropIfExists('bkpp_layanans');
    }
};
