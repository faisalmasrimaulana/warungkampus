<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

/**
 * Model untuk foto produk.
 *
 * @property int $produk_id
 * @property string $path_fotoproduk
 */

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
