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
    Schema::table('pesanan_masuks', function (Blueprint $table) {
        $table->decimal('total', 10, 2)->after('harga');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('pesanan_masuks', function (Blueprint $table) {
        $table->dropColumn('total');
    });
}
};
