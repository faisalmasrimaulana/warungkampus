<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Illuminate\Http\Request;

class FotoProduk extends Model
{
    protected $table = 'fotoproduk';

    protected $fillable = [
        'produk_id',
        'path_fotoproduk'
    ];

    public function produk()
    {
        return $this->belongsTo(Product::class, 'produk_id');
    }
}
