<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
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

    public function loginAdmin(AdminLoginRequest $request)
    {
        $credentials = $request->only('admin_id', 'password');

        if (Auth::guard('admins')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'admin_id' => 'ID atau password salah.',
        ])->withInput($request->only('admin_id'));
    }

    public function logout(Request $request)
    {
        Auth::guard('admins')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda berhasil logout');
    }
}
