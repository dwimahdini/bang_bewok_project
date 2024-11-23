<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->after('id');
            $table->string('notel')->after('username');
            $table->string('email')->unique()->after('notel');
            $table->enum('posisi', ['staff', 'kepala_cabang', 'admin', 'manajer'])->after('email');
            $table->string('cabang')->after('posisi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['username', 'notel', 'email', 'posisi', 'cabang']);
        });
    }
};
