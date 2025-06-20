<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\MonthlySubscribe;
use App\Models\Product;
use App\Models\User;
use App\Models\WeeklySubscribe;
use Illuminate\Support\Facades\Storage;
use App\Models\Bantuan;

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
        $weekly = WeeklySubscribe::with(['user', 'product'])->latest()->get()->map(function ($item) {
            return (object)[
                'user' => $item->user,
                'products' => [$item->product->nama_produk ?? '-'],
                'type' => 'Mingguan',
                'created_at' => $item->created_at,
                'expired_at' => $item->created_at->addDays(7),
            ];
        });

        $monthly = MonthlySubscribe::with(['user', 'product1', 'product2'])->latest()->get()->map(function ($item) {
            return (object)[
                'user' => $item->user,
                'products' => [
                    $item->product1->nama_produk ?? '-',
                    $item->product2->nama_produk ?? '-',
                ],
                'type' => 'Bulanan',
                'created_at' => $item->created_at,
                'expired_at' => $item->created_at->addDays(30),
            ];
        });
        $subscriptions = $weekly->merge($monthly)->sortByDesc('created_at');
        $totalUsers = User::count();
        $totalUnverified = User::where('is_verified', false)->count();
        $totalActiveProduct = Product::where('is_sold', false)->count();
        $laporans = Bantuan::latest()->paginate(3);
        return view('admin.dashboardadmin', compact('users', 'totalUsers', 'totalUnverified', 'totalActiveProduct', 'products', 'subscriptions', 'laporans'));
    }

    public function kelolaUser(){
        $users = User::latest()->paginate(10);
        return view('admin.kelolaUser', compact('users'));
    }

    public function kelolaLangganan(){
        $users = User::latest()->paginate(10);
        $weekly = WeeklySubscribe::with(['user', 'product'])->latest()->get()->map(function ($item) {
            return (object)[
                'user' => $item->user,
                'products' => [$item->product],
                'type' => 'Mingguan',
                'created_at' => $item->created_at,
                'expired_at' => $item->created_at->addDays(7),
            ];
        });

        $monthly = MonthlySubscribe::with(['user', 'product1', 'product2'])->latest()->get()->map(function ($item) {
            return (object)[
                'user' => $item->user,
                'products' => [
                    $item->product1,
                    $item->product2
                ],
                'type' => 'Bulanan',
                'created_at' => $item->created_at,
                'expired_at' => $item->created_at->addDays(30),
            ];
        });
        $subscriptions = $weekly->merge($monthly)->sortByDesc('created_at');
        return view('admin.kelolaLangganan', compact('subscriptions'));
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

    public function complete(Bantuan $bantuan)
    {
        $bantuan->complete();
        return back()->with('success', 'Laporan berhasil diselesaikan.');
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
