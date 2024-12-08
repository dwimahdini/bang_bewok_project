<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';

    protected $fillable = [
        'produk_id',
        'jumlah',
        'harga',
        'total',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
