<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $midtrans;

    public function __construct(PaymentController $midtrans)
    {
        $this->midtrans = $midtrans;
    }

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
