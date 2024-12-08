<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('name'); // Nama pengguna
            $table->string('email')->unique(); // Email unik
            $table->timestamp('email_verified_at')->nullable(); // Verifikasi email
            $table->string('password'); // Password
            $table->string('role')->default('user'); // Tambahkan kolom role
            $table->rememberToken(); // Token untuk "remember me"
            $table->timestamps(); // Kolom created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}