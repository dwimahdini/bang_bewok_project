<?php


namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    // Periksa apakah role pengguna adalah 'admin' atau 'manajer'
    if (Auth::user()->role != 'admin' && Auth::user()->role != 'manajer') {
        abort(404); // Tampilkan halaman 404 jika role tidak sesuai
    }

    $produk = Produk::all()->map(function ($item) {
        $item->tanggal_kadaluarsa = Carbon::parse($item->tanggal_kadaluarsa);
        return $item;
    });

    $tersedia = $produk->where('status_tersedia', 'tersedia')->count();
    $menipis = $produk->where('status_tersedia', 'menipis')->count();
    $tidakTersedia = $produk->where('status_tersedia', 'tidak tersedia')->count();

    return view('inventori', compact('tersedia', 'menipis', 'tidakTersedia', 'produk'));
}



    /**
     * Store a new product in the database.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'nama_produk' => 'required|string|max:255',
        'jumlah' => 'required|integer|min:0',
        'harga' => 'required|numeric|min:0',
        'satuan' => 'required|string|max:50',
        'tanggal_kadaluarsa' => 'required|date',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    try {
        // Membuat entri baru di tabel Produk
        $produk = new Produk();
        $produk->fill($request->all());

        // Logika penyimpanan gambar
        if ($request->hasFile('gambar')) {
            $filename = $request->nama_produk . '-' . now()->timestamp . '.' . $request->file('gambar')->getClientOriginalExtension();
            $request->file('gambar')->move('img/', $filename); // Pindahkan file ke folder 'foto'
            $produk->gambar = $filename; // Simpan nama file ke field 'gambar'
        }

        $produk->save();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Gagal menambahkan produk: ' . $e->getMessage());
    }
}


    public function edit($id)
    {
        if (Auth::user()->role != 'admin') {
            abort(404); 
        }

    $produk = Produk::findOrFail($id);
    return response()->json($produk);
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'nama_produk' => 'required|string|max:255',
        'jumlah' => 'required|integer|min:0',
        'harga' => 'required|numeric|min:0',
        'satuan' => 'required|string|max:50',
        'tanggal_kadaluarsa' => 'required|date',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $produk = Produk::findOrFail($id);

    if ($request->hasFile('gambar')) {
    if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
        Storage::disk('public')->delete($produk->gambar);
    }

    // Simpan gambar baru
    $file = $request->file('gambar');
    $fileName = time() . '_' . $file->getClientOriginalName();
    $filePath = $file->storeAs('images', $fileName, 'public');
    $produk->gambar = $filePath;
}


    // Update data produk
    $produk->update($request->except('gambar'));
    
    // Simpan gambar jika ada
    if (isset($fileName)) {
        $produk->save();
    }

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

    public function berandaAdmin()
    {
        if (Auth::user()->role != 'admin') {
            abort(404);
        }
        $produkTersedia = Produk::where('status_tersedia', 'tersedia')->count();
        $produkMenipis = Produk::where('status_tersedia', 'menipis')->count();
        $produkTidakTersedia = Produk::where('status_tersedia', 'tidak tersedia')->count();

        return view('beranda', compact('produkTersedia', 'produkMenipis', 'produkTidakTersedia'));
    }
}
