<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemovePhotoFromPenggunaakunTable extends Migration
{
    public function up()
    {
        Schema::table('penggunaakun', function (Blueprint $table) {
            $table->dropColumn('photo');
        });
    }

    public function down()
    {
        Schema::table('penggunaakun', function (Blueprint $table) {
            $table->string('photo')->nullable();
        });
    }
}