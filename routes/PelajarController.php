<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
Route::get('/pelajar', function () {
        return view('pages.pelajar');
    });
Route::get('/pelajar', function () {
    
    // SATPAM PENJAGA
    if (session('role') != 'member') {
        return redirect('/login')->with('error', 'Akses Ditolak! Anda harus Login.');
    }

    // JIKA AMAN, BUKA HALAMAN
    return view('pages.pelajar');
    
});
use Illuminate\Support\Facades\DB;
Route::get('/pelajar', function () {
    
    // Satpam Penjaga
    if (session('role') != 'member') {
        return redirect('/login')->with('error', 'Akses Ditolak! Anda harus Login.');
    }

    // AMBIL DATA DARI DATABASE (Ganti 'data_pelajar' dengan nama tabel asli Anda)
    $pelajar = DB::table('data_pelajar')->get();

    // KIRIM DATA KE HALAMAN BLADE
    return view('pages.pelajar', ['data_pelajar' => $pelajar]);
    
});