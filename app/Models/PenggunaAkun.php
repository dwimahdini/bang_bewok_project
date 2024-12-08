<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenggunaAkun extends Model
{
    use HasFactory;

    protected $table = 'penggunaakun';

    protected $fillable = [
        'nama', 'posisi', 'cabang', 'password', 'notel', 'email'
    ];
}
