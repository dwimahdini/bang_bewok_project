<?php

namespace App\Http\Controllers;

use App\Models\KeranjangPesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangPesananController extends Controller
{
    public function addToCart(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $validated = $request->validate([
            'productId' => 'required|integer',
            'quantity' => 'required|integer|min:1',
        ]);

        // Menambahkan produk ke keranjang
        KeranjangPesanan::create([
            'user_id' => Auth::id(),
            'produk_id' => $validated['productId'],
            'jumlah' => $validated['quantity'],
        ]);

        return response()->json(['success' => true]);
    }

    public function viewCart()
    {
        $keranjang = KeranjangPesanan::with('produk')
            ->where('user_id', Auth::id())
            ->get();

        return view('KeranjangPesanan', compact('keranjang'));
    }

    public function batalPesanan($id)
    {
        // Temukan item di keranjang berdasarkan ID
        $item = KeranjangPesanan::find($id);

        if ($item) {
            $item->delete(); // Hapus item
            return response()->json(['message' => 'Pesanan berhasil dibatalkan.'], 200);
        }

        return response()->json(['message' => 'Item tidak ditemukan.'], 404);
    }
}
