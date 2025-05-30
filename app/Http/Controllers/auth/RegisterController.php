<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Controller untuk menangani registrasi user:
 * - Menampilkan form registrasi
 * - Memproses registrasi user
 */

class RegisterController extends Controller
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
            'whatsapp' => 'nullable|string|regex:/^62\d{8,13}$/',
            'instagram' => 'nullable|string',
            'ktm' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'alamat' => 'required|string',
        ],[
            'nama.required' => 'Nama wajib diisi',
            'nim.required' => 'NIM wajib diisi',
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
            'ktm.required' => 'Foto KTM wajib diunggah',
            'email.email' => 'Format email salah',
            'email.unique' => 'Email sudah digunakan',
            'nim.unique' => 'NIM sudah digunakan',
            'ktm.max' => 'Ukuran foto maksimal 5 mb',
            'ktm.image' => 'File harus berupa foto',
            'alamat.required' => 'Alamat wajib diisi',
            'whatsapp.regex' => "Nomor Whatsapp dimulai dengan kode negara (ex:6281234567)"
        ]);

        if(!$request->hasFile('ktm')){
            return back()->withErrors(['ktm' => 'File KTM wajib diunggah']);
        }

        $ktmPath = $request->file('ktm')->store('ktm', 'public');
        
        if (!$ktmPath) {
        return back()->withErrors(['ktm' => 'Gagal mengunggah file KTM.']);
}
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
