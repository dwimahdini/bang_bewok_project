<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeranjangPesanan extends Model
{
    use HasFactory;

    protected $table = 'keranjang_pesanan'; // Nama tabel di database
    protected $fillable = [
        'user_id', // Jika Anda ingin mengaitkan keranjang dengan pengguna
        'produk_id',
        'jumlah',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
