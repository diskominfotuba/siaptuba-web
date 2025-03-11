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
        Schema::create('lhkpns', function (Blueprint $table) {
            $table->id();
            $table->string('td_1');
            $table->string('td_2');
            $table->string('td_3')->nullable();
            $table->timestamps();
            // td = table data
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lhkpns');
    }
};
