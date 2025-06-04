<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\User;
use App\Models\PaymentHistory;
use App\Models\Order;
/**
 * Controller untuk dashboard user.
 * - Menampilkan produk milik user yang sedang login.
 */

class DashboardUserController extends Controller
{
    public function index(){
        $user = Auth::user();

        $products = Product::where('mahasiswa_id', $user->id)
                    ->with('fotoproduk')
                    ->get();


        // Ambil semua payment history dari produk yang dimiliki user
        $paymentHistories = Order::whereHas('product', function ($query) use ($user) {
        $query->where('mahasiswa_id', $user->id);
    })->orderBy('created_at', 'desc')->paginate(5);

        return view('user.dashboard', [
            'products' => $products,
            'paymentHistories' => $paymentHistories,
        ]);
    }


    public function showPublic(User $user){
        $products = $user->produk()->where('is_sold', false)->paginate(10);
        return view('user.publicprofile', compact('user','products'));
    }
}
