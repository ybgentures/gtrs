<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // Fungsi untuk menampilkan halaman HTML/Blade (View)
    public function showLogin()
    {
        return view('auth.login');
    }

    // Fungsi untuk memproses data dari Form (Logika)
    public function prosesLogin(Request $request)
    {
        // 1. Tangkap inputan form
        $no_id = $request->input('no_id');
        $password = $request->input('password');

        // 2. Cek langsung ke tabel data_pelajar (bukan tabel users)
        $pelajar = DB::table('data_pelajar')->where('no_id', $no_id)->first();

        // 3. Jika data ditemukan DAN password cocok
        if ($pelajar && Hash::check($password, $pelajar->password)) {
            
            // 4. Simpan ke Session Laravel
            Session::put('no_id', $pelajar->no_id);
            Session::put('nama', $pelajar->nama_lengkap); 
            
            // Simpan nama file foto ke session (jika kosong, pakai default.jpg)
            Session::put('foto', $pelajar->foto ?? 'default.jpg');
            Session::put('baru_login', true);

            // (Opsional) Jika kamu butuh penanda role, kamu bisa mengaturnya secara manual di sini:
            // Session::put('role', 'siswa');

            // 5. Arahkan kembali ke halaman utama jika sukses
            return redirect('/');
        }

        // 6. JIKA GAGAL: Tendang balik ke halaman login dan bawa pesan error
        return back()->withErrors(['error' => 'Nomor ID atau Password salah!']);
    }

    // Fungsi untuk menghancurkan sesi (Logout)
    public function logout()
    {
        // 1. Hancurkan semua sesi
        Session::flush();

        // 2. Arahkan kembali ke halaman beranda
        return redirect('/');
    }
}