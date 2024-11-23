<?php

use App\Http\Controllers\BahanBakuContoller;
use Illuminate\Support\Facades\Route;

Route::get('/inventory',[BahanBakuContoller::class, 'index']);
Route::get('/tambahInventory', [BahanBakuContoller::class, 'create']);
Route::post('/tambahInventory', [BahanBakuContoller::class, 'store']);
Route::delete('/inventory/{id}', [BahanBakuContoller::class, 'delete']);
Route::put('/inventory/{id}', [BahanBakuContoller::class, 'edit']);
Route::put('/inventory/{id}', [BahanBakuContoller::class, 'update']);


// Route::get('/inventory', function () {
//         return view('inventory');
//     });

Route::get('/Halaman-Login', function () {
    return view('login');
});

Route::get('/beranda', function () {
    return view('beranda');
});

Route::get('/pengelolaan', function () {
    return view('pengelolaan');
});

Route::get('/tambahAkun', function () {
    return view('tambahAkun');
});

Route::get('/tambahCabang', function () {
    return view('tambahCabang');
});

Route::get('/laporan', function () {
    return view('laporan');
});

Route::get('/kelolaPengguna', function () {
    return view('kelolaPengguna');
});

Route::get('/pesananMasuk', function () {
    return view('pesananMasuk');
});

Route::get('/pesan', function () {
    return view('pesan');
});

Route::get('/cabang', function () {
    return view('cabang');
});


