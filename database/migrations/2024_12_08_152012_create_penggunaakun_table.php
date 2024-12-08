<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenggunaakunTable extends Migration
{
    public function up()
    {
        Schema::create('penggunaakun', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('posisi', ['manajer', 'kepala cabang', 'staf']);
            $table->unsignedInteger('cabang')->nullable();
            $table->string('password');
            $table->string('notel', 20);
            $table->string('email')->unique();
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penggunaakun');
    }
}
