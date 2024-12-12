<?php

namespace App\Http\Controllers;

use App\Models\PesananMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananMasukController extends Controller
{
    public function index()
    {
        if (Auth::user()->role != 'admin') {
            abort(404); 
        }
        $pesananMasuk = PesananMasuk::with('produk')->get();
        return view('pesananMasuk', compact('pesananMasuk'));
    }
} 