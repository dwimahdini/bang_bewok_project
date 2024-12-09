<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTotalToPesananMasuksTable extends Migration
{
    public function up()
    {
        Schema::table('pesanan_masuks', function (Blueprint $table) {
            $table->decimal('total', 10, 2)->after('harga');
        });
    }

    public function down()
    {
        Schema::table('pesanan_masuks', function (Blueprint $table) {
            $table->dropColumn('total');
        });
    }
} 