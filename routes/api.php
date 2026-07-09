<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| API Routes Gentures
|--------------------------------------------------------------------------
*/

// 1. API: MENCARI SATU PELAJAR BERDASARKAN NO ID (Method: GET)
Route::get('/pelajar/{no_id}', function ($no_id) {
    // Mencari siswa spesifik
    $pelajar = DB::table('data_pelajar')->where('no_id', $no_id)->first();

    // Jika data tidak ditemukan di database
    if (!$pelajar) {
        return response()->json([
            'status' => 'gagal',
            'pesan' => 'Maaf, pelajar dengan No ID tersebut tidak ditemukan.'
        ], 404); // 404 artinya Not Found
    }

    // Jika ketemu, kembalikan datanya (password disembunyikan demi keamanan)
    return response()->json([
        'status' => 'sukses',
        'data' => [
            'no_id' => $pelajar->no_id,
            'nama_lengkap' => $pelajar->nama_lengkap,
            'foto' => $pelajar->foto ?? 'default.jpg',
            'dibuat_pada' => $pelajar->created_at
        ]
    ], 200);
});


// 2. API: LOGIN UNTUK APLIKASI MOBILE / PIHAK LUAR (Method: POST)
Route::post('/login', function (Request $request) {
    $no_id = $request->input('no_id');
    $password = $request->input('password');

    // Cari pelajar di database
    $pelajar = DB::table('data_pelajar')->where('no_id', $no_id)->first();

    // Validasi kecocokan password
    if ($pelajar && Hash::check($password, $pelajar->password)) {
        return response()->json([
            'status' => 'sukses',
            'pesan' => 'Autentikasi berhasil!',
            'user' => [
                'no_id' => $pelajar->no_id,
                'nama' => $pelajar->nama_lengkap
            ]
        ], 200);
    }

    // Jika salah
    return response()->json([
        'status' => 'gagal',
        'pesan' => 'Nomor ID atau Password salah!'
    ], 401); // 401 artinya Unauthorized / Tidak Diizinkan
});

Route::post('/saran', function (Request $request) {
    // 1. Tangkap data dari form (pastikan huruf kecil semua agar rapi)
    $nama = $request->input('nama');
    $peran = $request->input('peran');
    $pesan = $request->input('pesan');

    // 2. Validasi sederhana
    if (!$nama || !$pesan) {
        return response()->json([
            'status' => 'gagal',
            'pesan' => 'Nama dan pesan tidak boleh kosong!'
        ], 400);
    }

    // 3. PROSES SIMPAN NYATA KE DATABASE KAMU:
    DB::table('saran')->insert([
        'nama' => $nama,
        'peran' => $peran ?? 'Anonim',
        'pesan' => $pesan,
        'created_at' => now(),
        'updated_at' => now()
    ]);

    // 4. Beri balasan sukses dalam bentuk JSON
    return response()->json([
        'status' => 'sukses',
        'pesan' => 'Terima kasih, saran kamu berhasil disimpan langsung di database Gentures!'
    ], 201);
});
// API untuk melihat semua saran yang masuk ke database
Route::get('/lihat-saran', function () {
    $semuaSaran = DB::table('saran')->orderBy('id', 'desc')->get();
    
    return response()->json([
        'status' => 'sukses',
        'total_saran' => $semuaSaran->count(),
        'daftar_saran' => $semuaSaran
    ]);
});