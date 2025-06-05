<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FotoProduk;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    public function index() {
        $products = Product::with('fotoproduk')->latest()->paginate(15);
        return view('product.daftarproduk', compact('products'));
    }

    public function store(Request $request){
        $validated = $request->validated();

        $mahasiswaId = Auth::id();
        $data = [
            'nama_produk' => $validated['nama_produk'],
            'kategori' => $validated['kategori'],
            'harga' => $validated['harga'],
            'deskripsi_singkat' => $validated['deskripsi_singkat'],
            'deskripsi_lengkap' => empty($validated['deskripsi_lengkap']) ? $validated['deskripsi_singkat'] : $validated['deskripsi_lengkap'],
            'mahasiswa_id' => $mahasiswaId,
        ];

        if ($validated['kategori'] === 'barang') {
            $data['kondisi'] = $validated['kondisi'];
        }

        $product = Product::create($data);

        foreach($request->file('productImages') as $image){
            $path = $image->store('produk', 'public');
            FotoProduk::create([
                'produk_id' => $product->id,
                'path_fotoproduk' => $path,
            ]);
        }
        return redirect()->route('produk.detail', $product->id)->with('success', 'Produk Berhasil Diposting');
    }

    public function show($id){
        $product = Product::with('fotoproduk', 'mahasiswa')->findOrFail($id);
        return view('product.detailproduk', compact('product'));
    }

    public function filter(Request $request) {
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
        ->paginate(15);

        return view('product.daftarproduk', compact('products'));
    }


    public function cari(Request $request){
        $keyword = $request->input('search', '');

        $products = Product::with('fotoproduk')
        ->when($keyword, function($query, $keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('nama_produk', 'like', "%{$keyword}%")
                  ->orWhere('deskripsi_singkat', 'like', "%{$keyword}%")
                  ->orWhere('deskripsi_lengkap', 'like', "%{$keyword}%")
                  ->orWhere('kondisi', 'like', "%{$keyword}%");
            });
        })
        ->paginate(15);

        return view('product.daftarproduk', compact('products', 'keyword'));
    }

    public function destroy($id){
        $product = Product::with('fotoproduk')->find($id);

        if(!$product){
            return redirect()->back()->with('error', 'Produk tidak ditemukan');
        }

        foreach($product->fotoproduk as $foto){
            Storage::disk('public')->delete($foto->path_fotoproduk);
            $foto->delete();
        }

        $product->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus');
    }

    public function edit($id){
        $product = Product::with('fotoproduk')->findOrFail($id);

        if($product->mahasiswa_id != Auth::id()){
            abort(403);
        }
        return view('product.editpost', compact('product'));
    }

    public function update(Request $request, $id){
        $product = Product::with('fotoproduk')->findOrFail($id);

        if($product->mahasiswa_id != Auth::id()){
            abort(403);
        }

        $validated = $request->validate([
        "nama_produk" => "required|string",
        "kategori" => "required|string",
        "harga" => "required",
        "deskripsi_singkat" => "required|max:100|string",
        "deskripsi_lengkap" => "nullable|string",
        "kondisi" => "nullable|string",
        "productImages" => "nullable|array|max:5",
        "productImages.*" => "image|mimes:jpg,png,jpeg|max:3072"
        ]);

        $product->update([
            'nama_produk' => $validated['nama_produk'],
            'kategori' => $validated['kategori'],
            'harga' => $validated['harga'],
            'deskripsi_singkat' => $validated['deskripsi_singkat'],
            'deskripsi_lengkap' => empty($validated['deskripsi_lengkap']) ? $validated['deskripsi_singkat'] : $validated['deskripsi_lengkap'],
            'kondisi' => $validated['kategori']  === 'barang' ? $validated['kondisi'] : 'nocondition',
        ]);

        if ($request->hasFile('productImages') ){
            foreach($request->file('productImages') as $image ){
                $path = $image->store('produk', 'public');
                FotoProduk::create([
                    'produk_id' => $product->id,
                    'path_fotoproduk' => $path,
                ]);
            }
        }

        if ($request->has('deleted_fotos')) {
            $deletedFotos = $request->input('deleted_fotos'); // array id foto yg mau dihapus
            foreach ($deletedFotos as $fotoId) {
                $foto = FotoProduk::find($fotoId);
                if ($foto) {
                    Storage::delete($foto->path_fotoproduk);
                    // Hapus record di DB
                    $foto->delete();
                }
            }
        }


        return redirect()->route('produk.detail', $product->id)->with('success', 'produk berhasil di update');
    }

    public function markAsSold($id){
        $product = Product::findOrFail($id);
        
        // Pastikan user yang punya produk yang bisa update (cek otorisasi)
        if ($product->mahasiswa_id != Auth::id()) {
            abort(403, "Unauthorized");
        }
    
        $product->is_sold = true;
        $product->save();
    
        return redirect()->back()->with('success', 'Produk berhasil ditandai sebagai terjual!');
    }

    public function unmarkAsSold($id){
        $product = Product::findOrFail($id);

        if ($product->mahasiswa_id != Auth::id()) {
            abort(403, "Unauthorized");
        }

        $product->is_sold = false;
        $product->save();

        return redirect()->back()->with('success', 'Produk berhasil diaktifkan kembali!');
    }

    protected $midtrans;

    public function createTransaction()
    {
        $params = [
            'transaction_details' => [
                'order_id' => uniqid(),
                'gross_amount' => 10000,
            ],
            'customer_details' => [
                'first_name' => 'Budi',
                'email' => 'budi.pra@example.com',
                'phone' => '08111222333',
            ],
        ];

        $snapToken = $this->midtrans->getSnapToken($params);

        return view('payment.index', compact('snapToken'));
    }

}
