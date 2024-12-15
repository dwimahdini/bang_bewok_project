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
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->foreignId('produk_id')->constrained('produk')->onDelete('cascade');
            $table->integer('jumlah'); // Jumlah produk yang dipesan
            $table->decimal('harga', 10, 2); // Harga satuan
            $table->decimal('total', 10, 2); // Total harga
            $table->timestamps(); // created_at dan updated_at

            // Relasi ke tabel produk
            $table->foreign('produk_id')->references('id')->on('produk')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
