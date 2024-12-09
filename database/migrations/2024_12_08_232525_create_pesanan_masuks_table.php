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
    Schema::create('pesanan_masuks', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('produk_id');
        $table->integer('jumlah');
        $table->timestamps();

        $table->foreign('produk_id')->references('id')->on('produk')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan_masuks');
    }
};
