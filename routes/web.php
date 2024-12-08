<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProdukController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\OrderController;

// Route untuk mengambil produk di database lalu ditampilkan
Route::get('/inventori', [ProdukController::class, 'index'])->name('produk.index');
// Route untuk menyimpan produk ke database
Route::post('/produk/store', [ProdukController::class, 'store'])->name('produk.store');
// Route untuk mengedit produk
Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
// Route menghapus produk
Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');

Route::get('/staf', [StaffController::class, 'index']);
Route::post('/staff/store', [StaffController::class, 'store'])->name('staff.store');
Route::get('/staf', [StaffController::class, 'index'])->name('staff.index');
Route::delete('/staff/{id}', [StaffController::class, 'destroy'])->name('staff.destroy');
Route::get('/staff/{id}/edit', [StaffController::class, 'edit'])->name('staff.edit');
Route::put('/staff/{id}', [StaffController::class, 'update'])->name('staff.update');

Route::get('/cabang', [CabangController::class, 'index'])->name('cabang.index');
Route::post('/cabangs', [CabangController::class, 'store'])->name('cabangs.store');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pesan', [PesanController::class, 'index'])->name('pesan.index');   

Route::get('/beranda', function () {
    return view('beranda');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/pengelolaan', function () {
    return view('pengelolaan');
});     

Route::post('/keranjangStaf', [KeranjangController::class, 'addToCart'])->name('keranjangStaf');

// Rute untuk menampilkan keranjang staf
Route::get('/keranjangStaf', [KeranjangController::class, 'viewCart'])->name('keranjangStaf.view');

Route::post('/tambah-ke-keranjang', [PesanController::class, 'tambahKeKeranjang'])->name('tambahKeKeranjang');