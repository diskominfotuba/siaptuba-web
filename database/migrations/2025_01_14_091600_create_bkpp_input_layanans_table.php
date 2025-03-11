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
        Schema::create('bkpp_input_layanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('layanan_id')->index()->references('id')->on('bkpp_layanans')->onDelete('cascade');
            $table->text('nama_input');
            $table->text('slug');
            $table->enum('required', ['y', 'n'])->default('y');
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
        Schema::dropIfExists('bkpp_input_layanans');
    }
};
