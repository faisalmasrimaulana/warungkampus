<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\FotoProduk;

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
}
