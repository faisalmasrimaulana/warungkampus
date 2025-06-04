<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$clientKey = config('midtrans.client_key');
        Config::$isProduction = false; 
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function process(Request $request)
    {
        $validator = Validator::make($request->all(), [
        'nama_pembeli' => 'required|string|max:255',
        'email_pembeli' => 'required|email',
        'no_hp_pembeli' => 'required|string',
        'alamat_pembeli' => 'required|string',
        'product_id' => 'required|exists:produk,id',
        'catatan' => 'nullable|string|max:500',
    ], [
        'nama_pembeli.required' => 'Nama pembeli wajib diisi',
        'nama_pembeli.max' => 'Nama pembeli maksimal 255 karakter',
        'email_pembeli.required' => 'Email pembeli wajib diisi',
        'email_pembeli.email' => 'Email pembeli harus valid memiliki @',
        'no_hp_pembeli.required' => 'Nomor hp pembeli harus wajib diisi',
        'alamat_pembeli.required' => 'Alamat pembeli wajib diisi',
        'catatan.max' => 'Catatan maksimal 500 karakter'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->errors()
        ], 422);
    }


        $orderId = 'ORDER-' . uniqid();
        $product = Product::findOrFail($request->product_id);
        $harga = $product->harga;

        $order = Order::create([
            'order_id' => $orderId,
            'nama_pembeli' => $request->nama_pembeli,
            'email_pembeli' => $request->email_pembeli,
            'no_hp_pembeli' => $request->no_hp_pembeli,
            'alamat_pembeli' => $request->alamat_pembeli,
            'product_id' => $request->product_id,
            'harga' => $harga,
            'status' => 'pending',
            'catatan' => $request->catatan,
        ]);

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $harga,
            ],
            'customer_details' => [
                'first_name' => $request->nama_pembeli,
                'email' => $request->email_pembeli,
                'phone' => $request->no_hp_pembeli,
                'billing_address' => [
                    'address' => $request->alamat_pembeli,
                ],
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params); // <-- Ini generate token, bukan redirect_url
            return response()->json(['snapToken' => $snapToken]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal memulai pembayaran: ' . $e->getMessage()], 500);
        }
    }

    public function success(Request $request)
{
    // Ambil order_id dari query param, misal ?order_id=ORDER-xxxx
    $orderId = $request->query('order_id');

    if (!$orderId) {
        return redirect('/')->with('error', 'Order ID tidak ditemukan');
    }

    $order = Order::where('order_id', $orderId)->first();

    if (!$order) {
        return redirect('/')->with('error', 'Order tidak ditemukan');
    }

    $order->status = 'success';
    $order->save();

    return view('payment.success', compact('order'));
}


}
