<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCabangsTable extends Migration
{
    /**
     * Jalankan migrasi.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cabangs', function (Blueprint $table) {
            $table->id();
            $table->string('image_path'); // Jalur ke gambar cabang
            $table->string('nama'); // Nama cabang
            $table->string('provinsi'); // Provinsi
            $table->string('kota'); // Kota
            $table->string('nomor_telepon'); // Nomor telepon
            $table->timestamps(); // Tanggal dibuat dan diperbarui
        });
    }

    /**
     * Balikkan migrasi.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cabangs');
    }
}
