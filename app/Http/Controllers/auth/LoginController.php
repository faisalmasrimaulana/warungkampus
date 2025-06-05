<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
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
    public function showLoginForm(){
        if(Auth::check()){
            return redirect()->route('user.dashboard');
        }
        return view('auth.login');
    }

    public function login(LoginRequest $request){
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (!Auth::user()->is_verified) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Akun kamu belum diverifikasi oleh admin.',
                ]);
            }
            $request->session()->regenerate();
            return redirect()->intended(route('user.dashboard'));
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
