<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

//CONTROLLER UNTUK MENANGANI REGISTRASI USER
//showRegisterForm untuk menampilkan halaman register ketika dipanggil route
//register untuk menangani input dan menambahkannya ke database
//logout menghapus session user


class RegisController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|unique:users,nim',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'whatsapp' => "string|regex:/^62\d{8,13}$/",
            'instagram' => 'string',
            'ktm' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'alamat' => 'required|string',
        ],[
            'whatsapp.regex' => "Nomor Whatsapp dimulai dengan kode negara (ex:6281234567)"
        ]);

        $ktmPath = $request->file('ktm')->store('ktm', 'public');

        User::create([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email' => $request->email,
            'whatsapp' => $request->whatsapp,
            'instagram' => $request->instagram,
            'password' => Hash::make($request->password),
            'ktm' => $ktmPath,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('login.submit')->with('success', 'Registrasi berhasil. Silakan login.');
    }
}
