<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    use HasFactory;

    protected $table = 'cabangs'; // Nama tabel di database
    protected $fillable = [
        'nama',
        'jalan',
        'provinsi',
        'kota',
        'nomor_telepon',
        'image_path',
        // Tambahkan field lain yang ingin Anda izinkan untuk mass assignment
    ];
}
