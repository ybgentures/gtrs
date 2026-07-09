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

// Menampilkan form HTML (GET) - Tambahkan ->name('login') di ujungnya
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

// --- INI SOLUSINYA: Rute untuk memproses data form (method POST) ---
Route::post('/login-proses', [AuthController::class, 'prosesLogin'])->name('login.proses');

// Proses Logout - Tambahkan ->name('logout') di ujungnya
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

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
require __DIR__ . '/web_catur.php'; // <-- Rute mini-game catur 6x6 (Los Alamos Chess)