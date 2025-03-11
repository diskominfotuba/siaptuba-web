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
        Schema::table('izins', function (Blueprint $table) {
            $table->enum('approval_status', ['disetujui', 'ditolak', 'pending'])->after('status')->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('izins', function (Blueprint $table) {
            $table->dropColumn('approval_status');
        });
    }
};
