<?php

namespace App\Http\Controllers;

use App\Models\PesananMasuk;
use Illuminate\Http\Request;

class PesananMasukController extends Controller
{
    public function index()
    {
        $pesananMasuk = PesananMasuk::with('produk')->get();
        return view('pesananMasuk', compact('pesananMasuk'));
    }
} 