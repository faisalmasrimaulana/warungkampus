<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bantuan;
use Illuminate\Support\Facades\Redis;

class BantuanController extends Controller
{
    public function store(Request $request){
        $validate = $request->validate([
            'nama' => "required|string",
            'email' => "required|email",
            'detail_laporan' => "required|string",
            'bukti' => "nullable|mimes:jpg,png,jpeg,pdf|max:5120",
        ]);

        $path = null;
        if ($request->hasFile('bukti')) {
        $path = $request->file('bukti')->store('bukti-laporan', 'public');
        }

        Bantuan::create([
            'nama' => $validate['nama'],
            'email' => $validate['email'],
            'detail_laporan' => $validate['detail_laporan'],
            'bukti' => $path,
            'is_complete' => false,
        ]);
         return redirect()->route('bantuan')->with('success', 'Laporan berhasil dikirimkan');
    }    
}
