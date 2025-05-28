<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// CONTROLLER UNTUK MENANGANI LOGIN ADMIN
//showLoginAdminForm untuk menampilkan halaman loginadmin yang akan dipanggil oleh route loginadmin
//loginadmin akan menangani input dan verifikasi database, kemudian diarahkan ke dashboard admin
//logout akan menghapus session admin

class LoginAdminController extends Controller
{
    // Menampilkan form login
    public function showLoginAdminForm()
    {
        return view('admin.loginadmin');
    }

    // Proses login
    public function loginadmin(Request $request)
    {
        // Validasi input dari admin
        $request->validate([
            'admin_id' => 'required|exists:admins,admin_id',
            'password' => 'required',
        ]);

        // Ambil data adminId dan password
        $credentials = $request->only('admin_id', 'password');

        // Cek apakah kredensial valid
        if (Auth::guard('admins')->attempt($credentials)) {
            // Jika login berhasil, regenerasi session
            $request->session()->regenerate();

            // Redirect ke halaman dashboard
            return redirect()->intended('admin/dashboard');
        }

        // Jika gagal login, kembalikan dengan pesan error
        return back()->withErrors([
            'admin_id' => 'admin id atau password salah.',
        ]);
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
