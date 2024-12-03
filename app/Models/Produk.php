<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    
    protected $fillable = [
        'gambar', 
        'nama_produk', 
        'jumlah', 
        'harga', 
        'satuan', 
        'tanggal_kadaluarsa', 
        'status_tersedia',
        'status_kedaluarsa'
    ];

    protected $dates = ['tanggal_kadaluarsa'];
}