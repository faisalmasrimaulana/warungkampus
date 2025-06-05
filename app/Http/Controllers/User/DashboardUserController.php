<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
/**
 * Controller untuk dashboard user.
 * - Menampilkan produk milik user yang sedang login.
 */

class DashboardUserController extends Controller
{

    public function index(){
        $user = Auth::user();

        $products = Product::where('mahasiswa_id', $user->id)->with('fotoproduk')->latest()->paginate(10);

        $paymentHistories = Order::whereHas('product', function ($query) use ($user) {
        $query->where('mahasiswa_id', $user->id);
        })->with('product')->latest()->paginate(5);

        return view('user.dashboard', [
            'products' => $products,
            'paymentHistories' => $paymentHistories,
        ]);
    }


    public function showPublic(User $user){
        $products = $user->produk()->where('is_sold', false)->with('fotoproduk')->latest()->paginate(10);
        return view('user.publicprofile', compact('user','products'));
    }
}
