<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id(); // Kolom ID sebagai primary key
            $table->string('gambar')->nullable();
            $table->string('nama_produk');
            $table->integer('jumlah');
            $table->decimal('harga', 15, 2);
            $table->string('satuan');
            $table->date('tanggal_kadaluarsa');
            $table->enum('status_tersedia', ['tersedia', 'menipis', 'tidak_tersedia']);
            $table->enum('status_kedaluarsa', ['aman', 'mendekati', 'kedaluarsa']);
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
        Schema::dropIfExists('produk');
    }
}