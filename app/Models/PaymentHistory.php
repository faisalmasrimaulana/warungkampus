<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'order_id',
        'product_id',
        'transaction_status',
        'payment_type',
        'gross_amount',
        'transaction_time',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
