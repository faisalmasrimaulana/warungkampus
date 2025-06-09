<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeeklySubscribe extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'nama_pemilik_produk',
        'email_pemilik_produk',
        'harga',
        'status',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
