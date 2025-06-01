<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\FotoProduk;
use App\Models\User;

/**
 * @property int $id
 * @property string $nama_produk
 * @property string $kategori
 * @property string|null $kondisi
 * @property float $harga
 * @property string $deskripsi_singkat
 * @property string $deskripsi_lengkap
 * @property int $mahasiswa_id
 */

class Product extends Model
{
    protected $table = 'produk';

    protected $fillable = [
        'nama_produk',
        'kategori',
        'kondisi',
        'harga',
        'deskripsi_singkat',
        'deskripsi_lengkap',
        'mahasiswa_id'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'mahasiswa_id');
    }

    public function fotoproduk(){
        return $this->hasMany(FotoProduk::class, 'produk_id');
    }

    public function getThumbnailAttribute()
    {
        return $this->fotoproduk->first()->path_fotoproduk ?? 'default.jpg';
    }

    public function getHargaFormatAttribute()
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }
}
