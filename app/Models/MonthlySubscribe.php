<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlySubscribe extends Model
{
    protected $fillable = [
        'order_id',
        'user_id',
        'product_1_id',
        'product_2_id',
        'promo_message',
        'harga',
        'payment_status',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function product1()
    {
        return $this->belongsTo(Product::class, 'product_1_id');
    }

    public function product2()
    {
        return $this->belongsTo(Product::class, 'product_2_id');
    }

}
