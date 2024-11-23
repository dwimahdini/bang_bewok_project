<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BahanBaku extends Model
{
    use HasFactory;
    protected $table = 'bahanbaku';

    protected $fillable = [
        'namaProduk',
        'gambar',
        'satuan',
        'jumlah',
        'harga',
        'status',
        'tanggal_kadaluarsa', 
    ];


    public function getHargaFormattedAttribute()
    {
        return 'Rp ' . number_format($this->harga, 2, ',', '.');
    }

}