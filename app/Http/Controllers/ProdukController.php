<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Display a list of products
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $produk = Produk::all();

        // Convert tanggal_kadaluarsa to Carbon instances
        $produk->transform(function ($p) {
            $p->tanggal_kadaluarsa = Carbon::parse($p->tanggal_kadaluarsa);
            return $p;
        });

        return view('inventori', ['produk' => $produk]);
    }

    /**
     * Store a new product in the database.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_produk'       => 'required|string|max:255',
            'jumlah'            => 'required|integer|min:0',
            'harga'             => 'required|numeric|min:0.01',
            'satuan'            => 'required|string|max:255',
            'tanggal_kadaluarsa'=> 'required|date|after:today',
            'gambar'            => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $produk = new Produk();
            $produk->fill($validatedData);

            // Determine expiration status
            $tanggalKadaluarsa = Carbon::parse($validatedData['tanggal_kadaluarsa']);
            $hariIni = Carbon::now();

            if ($hariIni->greaterThanOrEqualTo($tanggalKadaluarsa)) {
                $produk->status_kedaluarsa = 'kedaluarsa';
            } elseif ($hariIni->diffInDays($tanggalKadaluarsa) <= 7) {
                $produk->status_kedaluarsa = 'mendekati';
            } else {
                $produk->status_kedaluarsa = 'aman';
            }

            // Determine availability status
            if ($validatedData['jumlah'] == 0) {
                $produk->status_tersedia = 'tidak_tersedia';
            } elseif ($validatedData['jumlah'] <= 5) {
                $produk->status_tersedia = 'menipis';
            } else {
                $produk->status_tersedia = 'tersedia';
            }

            // Handle image upload
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('produk', $fileName, 'public');
                $produk->gambar = $filePath;
            }

            $produk->save();

            return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan produk: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
    $produk = Produk::findOrFail($id);
    return response()->json($produk);
    }

    public function update(Request $request, $id)
    {
        // Validasi dan update produk
        $produk = Produk::findOrFail($id);
        $produk->update($request->all());

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Delete a product by ID.
     * 
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
            Storage::disk('public')->delete($produk->gambar);
        }

        $produk->delete();

        return redirect()->route('produk.index')->with('status', 'Produk berhasil dihapus!');
    }

    public function beranda()
    {
        $produkTersedia = Produk::where('status_tersedia', 'tersedia')->count();
        $produkMenipis = Produk::where('status_tersedia', 'menipis')->count();
        $produkTidakTersedia = Produk::where('status_tersedia', 'tidak tersedia')->count();

        return view('beranda', compact('produkTersedia', 'produkMenipis', 'produkTidakTersedia'));
    }
}
