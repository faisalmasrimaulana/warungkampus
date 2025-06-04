<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    protected $table = 'payment_histories';

    protected $fillable = [
        'order_id',
        'product_id',
        'transaction_status',
        'payment_type',
        'gross_amount',
        'transaction_time',
        'buyer_name',
        'buyer_email',
        'buyer_phone',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
}
