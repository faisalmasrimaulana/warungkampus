<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\User;

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

    public function showPublic(User $user){
        $products = $user->produk()->where('is_sold', false)->paginate(10);
        return view('user.publicprofile', compact('user','products'));
    }
}
