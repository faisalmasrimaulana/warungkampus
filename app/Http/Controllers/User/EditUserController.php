<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Controller untuk manajemen profil user.
 * 
 * Fitur:
 * - Menampilkan form edit profil user
 * - Memproses update data profil user
 * - Memproses update password user
 * 
 */

class EditUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit(User $user)
    {
        if(Auth::id() != $user->id){
            abort(403);
        }
        return view('user.editprofil', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if(Auth::id() != $user->id){
            abort(403);
        }
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'whatsapp' => "nullable|string|regex:/^62\d{8,13}$/",
            'instagram' => 'nullable|string',
            'alamat' => 'required|string',
        ],[
            'nama.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email sudah digunakan',
            'alamat.required' => 'Alamat wajib diisi',
            'whatsapp.regex' => "Nomor Whatsapp dimulai dengan kode negara (ex:6281234567)"
        ]);

        $user->nama = $request->input('nama');
        $user->email = $request->input('email');
        $user->whatsapp = $request->input('whatsapp');
        $user->instagram = $request->input('instagram');
        $user->alamat = $request->input('alamat');
        $user->bio = $request->input('bio');

        if ($request->hasFile('foto_profil')) {
            $image = $request->file('foto_profil');

            if ($user->foto_profil && Storage::disk('public')->exists($user->foto_profil)) {
                Storage::disk('public')->delete($user->foto_profil);
            }

            $path = $image->store('foto_profil', 'public');
            $user->foto_profil = $path;
        }

        $user->save();

        return redirect()->route('user.dashboard')->with('success', 'Profil berhasil diperbarui!');
    }

    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'currentPassword' => 'required',
            'newPassword' => [
                'required',
                'min:8',
                'different:currentPassword',
            ],
            'confirmNewPassword' => 'required|same:newPassword',
        ], [
            'newPassword.different' => 'Password baru tidak boleh sama dengan password lama.',
        ]);

        if (!Hash::check($request->currentPassword, $user->password)) {
            return back()->withErrors(['currentPassword' => 'Kata sandi lama salah.']);
        }

        $user->password = Hash::make($request->newPassword);
        $user->save();

        return redirect()->route('user.edit', $user->id)->with('success', 'Kata sandi berhasil diubah!');
    }

}