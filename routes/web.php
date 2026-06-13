<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('pages.index');
});
Route::get('/donasi', function () {
    return view('pages.donasi');
});

Route::get('/mpk', function () {
    return view('pages.mpk');
});

Route::get('/opmaz', function () {
    return view('pages.opmaz');
});

// Menampilkan form HTML (GET)
Route::get('/login', [AuthController::class, 'showLogin']);

// Memproses klik tombol submit dari form (POST)
Route::post('/login', [AuthController::class, 'prosesLogin']);

// Proses Logout
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/zaytun', function () {
        return view('pages.zaytun');
    });

Route::get('/jalankan-migrasi', function () {
    \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
    return "Selamat, tabel database berhasil dibuat!";
});

// Memanggil file rute tambahan agar ikut dibaca oleh Laravel
require __DIR__ . '/RememberController.php';
require __DIR__ . '/NewsController.php';
require __DIR__ . '/PelajarController.php';