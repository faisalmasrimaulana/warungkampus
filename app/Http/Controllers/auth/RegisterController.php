<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
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

    public function register(RegisterRequest $request)
    {
        $ktmPath = $request->file('ktm')->store('ktm', 'public');
        $data = $request->only([
            'nama',
            'nim',
            'email',
            'whatsapp',
            'instagram',
            'alamat',
        ]);

        $data['password'] = Hash::make($request->password);
        $data['ktm'] = $ktmPath;
        
        User::create($data);
        return redirect()->route('login.submit')->with('success', 'Registrasi berhasil. Silakan login.');
    }
}
