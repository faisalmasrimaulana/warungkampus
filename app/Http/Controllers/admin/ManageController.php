<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;

class ManageController extends Controller
{
    public function filterProduct(Request $request) {
        $products = Product::with('fotoproduk')
        ->when($request->filled('kategori'), function ($query) use ($request) {
            $query->where('kategori', strtolower($request->kategori));
        })
        ->when($request->filled('harga'), function ($query) use ($request) {
            if ($request->harga === 'Terendah') {
                $query->orderBy('harga','asc');
            } elseif ($request->harga === 'Tertinggi') {
                $query->orderByDesc('harga');
            }
        })
        ->when($request->filled('waktu'), function ($query) use ($request) {
            if ($request->waktu === 'Terbaru') {
                $query->orderByDesc('created_at');
            } elseif ($request->waktu === 'Terlama') {
                $query->orderBy('created_at', 'asc');
            }
        })
        ->when($request->filled('search'), function ($query) use ($request) {
            $query->where('nama_produk', 'like', '%' . $request->search . '%')
            ->orwhere('kategori', 'like', '%' . $request->search . '%')
            ->orwhere('kondisi', 'like', '%' . $request->search . '%')
            ->orwhere('deskripsi_singkat', 'like', '%' . $request->search . '%');})
        ->paginate(15)->withQueryString();

        return view('admin.kelolaPostingan', compact('products'));
    }

    public function filterUser(Request $request){
        $users = User::with('produk')
        ->when($request->filled('verifikasi'), function ($query) use ($request) {
            $verifikasi = $request->verifikasi === 'true' ? true : false;
            $query->where('is_verified', $verifikasi);
        })
        ->when($request->filled('blokir'), function ($query) use ($request) {
            $blokir = $request->blokir === 'true' ? true : false;
            $query->where('is_blocked', $blokir);
        })
        ->when($request->filled('waktu'), function ($query) use ($request) {
            if ($request->waktu === 'Terbaru') {
                $query->orderByDesc('created_at');
            } elseif ($request->waktu === 'Terlama') {
                $query->orderBy('created_at', 'asc');
            }
        })
        ->when($request->filled('search'), function ($query) use ($request) {
            $query->where('nama', 'like', '%' . $request->search . '%')
            ->orwhere('email', 'like', '%' . $request->search . '%')
            ->orwhere('whatsapp', 'like', '%' . $request->search . '%')
            ->orwhere('alamat', 'like', '%' . $request->search . '%');})
        ->paginate(15)->withQueryString();

        return view('admin.kelolaUser', compact('users'));
    }
}
