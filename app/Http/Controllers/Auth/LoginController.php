<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Ambil kredensial dari request
        $credentials = $request->only('email', 'password');

        // Coba untuk autentikasi
        if (Auth::attempt($credentials)) {
            // Jika autentikasi berhasil, redirect ke halaman yang diminta sebelumnya
            return redirect()->intended('/menu'); // Ganti 'dashboard' sesuai dengan rute yang diinginkan
        }

        // Jika gagal, kembali ke halaman login dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login'); // Ganti dengan rute halaman login Anda
    }
}
