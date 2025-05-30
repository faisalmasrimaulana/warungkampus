<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

/**
 * Controller untuk dashboard user.
 * - Menampilkan produk milik user yang sedang login.
 */

class DashboardUserController extends Controller
{
    public function index(){
        $user = Auth::user();
        $products = Product::where('mahasiswa_id', $user->id)->with('fotoproduk')->get();
        return view('user.dashboard', ['products'=> $products]);
    }
}
