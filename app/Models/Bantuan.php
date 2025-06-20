<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bantuan extends Model
{
    protected $table = 'bantuans';
    protected $fillable = [
        'nama',
        'email',
        'detail_laporan',
        'bukti',
        'is_complete'
    ];

    public function complete(){
        $this->update(['is_complete' => true]);
    }
}
