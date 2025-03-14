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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('opd_id');
            $table->string('nama');
            $table->string('nip');
            $table->string('jabatan');
            $table->string('unit_organisasi');
            $table->string('email')->unique();
            $table->string('no_hp');
            $table->string('role')->default('user');
            $table->string('status')->default('active');
            $table->enum('status_pegawai', ['asn', 'non_asn'])->default('asn');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('photo')->default('public/img/avatar.png');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
