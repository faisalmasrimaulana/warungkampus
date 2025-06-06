<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_id',
        'nama_pembeli',
        'email_pembeli',
        'no_hp_pembeli',
        'alamat_pembeli',
        'product_id',
        'harga',
        'status',
        'catatan',
        'nama_produk'
    ];

        public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
