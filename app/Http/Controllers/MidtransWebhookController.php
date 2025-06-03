<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\PaymentHistory;
use Illuminate\Support\Facades\Log;
use Midtrans\Notification;
use Midtrans\Config;

class MidtransWebhookController extends Controller
{
    public function handle(Request $request)
    {
        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production', false);

        try {
            $notif = new Notification(); // dapetin notif valid langsung dari Midtrans

            $transaction = $notif->transaction_status;
            $type = $notif->payment_type;
            $orderId = $notif->order_id;
            $grossAmount = $notif->gross_amount;
            $time = $notif->transaction_time;

            Log::info('Webhook diterima:', [
                'transaction_status' => $transaction,
                'payment_type' => $type,
                'order_id' => $orderId,
                'gross_amount' => $grossAmount,
                'transaction_time' => $time
            ]);

            $order = Order::where('order_id', $orderId)->first();

            if (!$order) {
                return response()->json(['message' => 'Order tidak ditemukan'], 404);
            }

            // Update status order
            $order->update(['status' => $transaction]);

            // Simpan ke history pembayaran
            PaymentHistory::create([
                'order_id' => $order->order_id,
                'product_id' => $order->product_id,
                'transaction_status' => $transaction,
                'payment_type' => $type,
                'gross_amount' => $grossAmount,
                'transaction_time' => $time,
                'buyer_name' => $order->nama_pembeli,
                'buyer_email' => $order->email_pembeli,
                'buyer_phone' => $order->no_hp_pembeli,
            ]);

            return response()->json(['message' => 'Webhook diproses'], 200);

        } catch (\Exception $e) {
            Log::error('Gagal memproses webhook Midtrans: ' . $e->getMessage());
            return response()->json(['message' => 'Internal server error'], 500);
        }
    }

    // Optional: Kalau mau hapus function callback() juga boleh
    public function callback(Request $request)
    {
        // Sama aja kayak handle(), bisa kamu hapus atau redirect ke handle()
        return $this->handle($request);
    }
}
