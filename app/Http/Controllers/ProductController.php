<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FotoProduk;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    public function postProduct(Request $request){
        $validated = $request->validate([
        "nama_produk" => "required|string",
        "kategori" => "required|string",
        "harga" => "required",
        "deskripsi_singkat" => "required|max:100|string",
        "deskripsi_lengkap" => "required|string",
        "kondisi" => "required_if:kategori,barang|string|nullable",
        "productImages" => "required|array|max:5",
        "productImages.*" => "image|mimes:jpg,png,jpeg|max:5120"
    ]);

    $mahasiswaId = Auth::id();
    $data = [
        'nama_produk' => $validated['nama_produk'],
        'kategori' => $validated['kategori'],
        'harga' => $validated['harga'],
        'deskripsi_singkat' => $validated['deskripsi_singkat'],
        'deskripsi_lengkap' => $validated['deskripsi_lengkap'],
        'mahasiswa_id' => $mahasiswaId,
    ];

    if ($validated['kategori'] === 'barang') {
        $data['kondisi'] = $validated['kondisi'];
    }

        $product = Product::create($data);

        foreach($request->file('productImages') as $image){
            $path = $image->store('produk', 'public');

            fotoproduk::create([
                'produk_id' => $product -> id,
                'path_fotoproduk' => $path,
            ]);
        }
        return redirect()->route('get.detail', $product->id)->with('success', 'Produk dan gambar berhasil disimpan');
    }

    public function showDetail($id){
        $product = Product::with('fotoproduk', 'mahasiswa')->findOrFail($id);
        return view('detailproduk', compact('product'));
    }

    public function daftarproduk() {
        $product = Product::all();
        return view('daftarproduk', compact('product'));
    }

}
