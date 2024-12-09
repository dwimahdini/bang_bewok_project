<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesananMasuk extends Model
{
    protected $fillable = ['produk_id', 'jumlah', 'harga', 'total'];

    // Definisikan relasi dengan model Produk
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
