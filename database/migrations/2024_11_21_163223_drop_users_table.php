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
        Schema::dropIfExists('userss'); // Menghapus tabel 'userss'
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Jika Anda ingin membuat tabel 'userss' kembali, Anda bisa menambahkannya di sini
        Schema::create('userss', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
    }
};
