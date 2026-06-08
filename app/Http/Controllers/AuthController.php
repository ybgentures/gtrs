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
        // 1. Tangkap inputan form (Laravel otomatis membersihkan dari hacker)
        $no_id = $request->input('no_id');
        $password = $request->input('password');

        // 2. Cek ke tabel users
        $user = DB::table('users')->where('no_id', $no_id)->first();

        // 3. Jika user ada DAN password cocok (menggantikan password_verify)
        if ($user && Hash::check($password, $user->password)) {
            
            // 4. Ambil biodata dari tabel data_pelajar
            $biodata = DB::table('data_pelajar')->where('no_id', $no_id)->first();

            // 5. Simpan ke Session Laravel
            Session::put('no_id', $user->no_id);
            Session::put('role', $user->role);
            
            if ($biodata) {
                // (Sesuaikan $biodata->nama dengan nama kolom asli di database Anda)
                Session::put('nama', $biodata->nama_lengkap ?? 'Siswa'); 
                
                // INI YANG BARU: Simpan nama file foto ke session (jika kosong, pakai default.jpg)
                Session::put('foto', $biodata->foto ?? 'default.jpg');
            } else {
                Session::put('nama', 'Pengguna');
                Session::put('foto', 'default.jpg');
            }
            Session::put('baru_login', true);

            // 6. Arahkan kembali ke halaman utama
            return redirect('/');
        }
    }
    // Fungsi untuk menghancurkan sesi (Logout)
    public function logout()
    {
        // 1. Hancurkan semua sesi (Pengganti session_unset dan session_destroy)
        Session::flush();

        // 2. Arahkan kembali ke halaman beranda (Pengganti header Location)
        return redirect('/');
    }
}