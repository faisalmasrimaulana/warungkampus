<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input dari user
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6', // sesuaikan panjang password jika perlu
        ]);

        // Ambil data email dan password
        $credentials = $request->only('email', 'password');

        // Cek apakah kredensial valid
        if (Auth::attempt($credentials)) {
            if (!Auth::user()->is_verified) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Akun kamu belum diverifikasi oleh admin.',
                ]);
            }

            $request->session()->regenerate();
            return redirect()->intended('/dashboard');

                // Jika gagal login, kembalikan dengan pesan error
            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ]);
        }
    }

    // Proses logout
    public function logout(Request $request)
    {
        // Logout user
        Auth::logout();

        // Hapus session dan token untuk keamanan
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman depan
        return redirect('/');
    }
}
