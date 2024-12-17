<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class PesanProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::all();
        return view('pesanProduk', compact('produk'));
    }
}
