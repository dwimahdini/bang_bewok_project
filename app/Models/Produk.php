<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;

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