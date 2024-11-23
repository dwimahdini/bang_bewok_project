<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bahanbaku', function (Blueprint $table) {
            $table->id('id'); // ID Produk sebagai primary key
            $table->string('produk'); // Nama produk
            $table->integer('jumlah'); // Jumlah bahan baku
            $table->decimal('harga', 10, 2); // Harga bahan baku dengan 2 desimal
            $table->date('tanggal_kadaluarsa'); // Tanggal kedaluwarsa
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bahanbaku');
    }
};