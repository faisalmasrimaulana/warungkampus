<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

/**
 * Controller untuk manajemen dashboard admin
 * - Hanya admin yang dapat mengakses controller ini
 * - Menampilkan User
 * - Verifikasi User
 * - Hapus User beserta file KTM
 */

class DashboardAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admins');
    }

    public function dashboard()
    {
        $users = User::orderByDesc('created_at')->paginate(3);
        $totalUsers = User::count();
        $totalUnverified = User::where('is_verified', 0)->count();
        $totalActiveProduct = User::with('produk')->get()->sum(function ($user){
            return $user->produk->where('is_sold', 0)->count();
        });
        return view('admin.dashboardadmin', compact('users', 'totalUsers', 'totalUnverified', 'totalActiveProduct'));
    }

    public function kelolaUser(){
        $users = User::orderByDesc('created_at')->paginate(10);
        return view('admin.kelolaUser', compact('users'));
    }

    public function verifikasi(User $user)
    {
        $user->is_verified = true;
        $user->save();
        return back()->with('success', 'User berhasil diverifikasi.');
    }

    public function destroy(User $user)
    {
        if (!empty($user->ktm) && Storage::disk('public')->exists($user->ktm)) {
            Storage::disk('public')->delete($user->ktm);
        }

        $user->delete();
        return back()->with('success', 'User berhasil dihapus.');
    }

}
