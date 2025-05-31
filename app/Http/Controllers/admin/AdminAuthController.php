<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Controller untuk menangani login admin:
 * - Menampilkan form login admin
 * - Pengecekan login admin
 * - Logout admin
 */

class AdminAuthController extends Controller
{

    public function showLoginAdminForm()
    {
        return view('admin.loginadmin');
    }

    public function loginAdmin(Request $request)
    {
        $request->validate(
            [
                'admin_id' => 'required|exists:admins,admin_id',
                'password' => 'required',
            ],
            [
                'admin_id.required' => 'ID admin harus diisi',
                'admin_id.exists' => 'ID admin tidak valid',
                'password.required' => 'Password wajib diisi'
            ]
        );

        $credentials = $request->only('admin_id', 'password');

        if (Auth::guard('admins')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'admin_id' => 'ID atau password salah.',
            'password' => 'ID atau password salah'
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::guard('admins')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
