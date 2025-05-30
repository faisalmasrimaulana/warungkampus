<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Controller untuk menangani login user:
 * - Menampilkan form login
 * - Memproses login user
 * - Logout user
 */

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate(
            [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
            ],
            [
                'email.required' => 'Email wajib diisi',
                'email.email' => 'Format email harus benar',
                'password.required' => 'Password harus diisi',
                'password.min' => 'Password minimal 6 kata'
            ]
        );

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (!Auth::user()->is_verified) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Akun kamu belum diverifikasi oleh admin.',
                ]);
            }
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
        
        return back()->withErrors([
            'email' => 'Email atau password salah.',
            'password' => 'Email atau password salah.'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
