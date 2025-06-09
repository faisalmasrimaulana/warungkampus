<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeeklySubscribe extends Model
{
    protected $fillable = [
        'order_id',
        'user_id',
        'product_id',
        'harga',
        'payment_status',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
