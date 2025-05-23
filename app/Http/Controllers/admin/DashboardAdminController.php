<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

// CONTROLLER UNTUK DASHBOARD ADMIN
// ShowUnverifiedUsers untuk menampilkan user yang belum diverifikasi
// index untuk menampilkan data seluruh user
// verifikasi untuk memverifikasi user yang baru mendaftar
// hapus untuk menghapus atau membatalkan pendaftaran user yang tidak memenuhi syarat, ini juga menghapus bukti foto KTM di local dan string di database

class DashboardAdminController extends Controller
{
    public function showUnverifiedUsers()
    {
        $users = User::where('is_verified', false)->get();
        return view('admin.verifikasi_user', compact('users'));
    }

    public function index()
    {
        $users = User::all();
        return view('admin.dashboardadmin', compact('users'));
    }

    public function verifikasi($id)
    {
        $user = User::findOrFail($id);
        $user->is_verified = true;
        $user->save();
        return back()->with('success', 'User berhasil diverifikasi.');
    }

    public function hapus($id)
    {
        $user = User::findOrFail($id);

        // Hapus file KTM jika ada di storage local
        if ($user->ktm && Storage::disk('public')->exists($user->ktm)) {
            Storage::disk('public')->delete($user->ktm);
        }

        // Hapus user dari database
        $user->delete();

        return back()->with('success', 'User berhasil dihapus.');
    }
}
