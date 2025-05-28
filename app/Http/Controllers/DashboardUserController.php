<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class DashboardUserController extends Controller
{
    public function showUserProduct(){

        $user = Auth::user();
        $products = Product::where('mahasiswa_id', $user->id)->with('fotoproduk')->get();
        return view('dashboard', ['product'=> $products]);
    }
}
