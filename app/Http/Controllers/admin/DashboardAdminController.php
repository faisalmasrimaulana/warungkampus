<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Product;
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
        $this->middleware('auth:admins');
    }

    public function dashboard()
    {
        $users = User::latest()->paginate(3);
        $products = Product::latest()->paginate(3);

        $totalUsers = User::count();
        $totalUnverified = User::where('is_verified', false)->count();
        $totalActiveProduct = Product::where('is_sold', false)->count();
        return view('admin.dashboardadmin', compact('users', 'totalUsers', 'totalUnverified', 'totalActiveProduct', 'products'));
    }

    public function kelolaUser(){
        $users = User::latest()->paginate(10);
        return view('admin.kelolaUser', compact('users'));
    }

    public function kelolaPostingan(){
        $products = Product::latest()->paginate(10);
        return view('admin.kelolaPostingan', compact('products'));
    }

    public function verifikasi(User $user)
    {
        $user->verifikasi();
        return back()->with('success', 'User berhasil diverifikasi.');
    }

    public function block(User $user)
    {
        $user->block();
        return back()->with('success', 'User berhasil diblokir.');
    }

    public function unblock(User $user)
    {
        $user->unblock();
        return back()->with('success', 'Blokir User berhasil dibuka.');
    }

    public function destroy(User $user)
    {
        $user->deleteKtm();
        $user->delete();
        return back()->with('success', 'User berhasil dihapus.');
    }
}
