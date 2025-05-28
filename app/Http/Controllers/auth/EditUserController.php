<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EditUserController extends Controller
{
    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('auth.editprofil', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        // Cari user
        $user = User::findOrFail($id);

        // Update field user
        $user->nama = $request->input('nama');
        $user->email = $request->input('email');
        $user->whatsapp = $request->input('whatsapp');
        $user->instagram = $request->input('instagram');
        $user->alamat = $request->input('alamat');
        $user->bio = $request->input('bio');

        // Upload foto profil jika ada
        if ($request->hasFile('foto_profil')) {
            // Ambil file dari input
            $image = $request->file('foto_profil');

            // Hapus foto lama jika ada
            if ($user->foto_profil && Storage::exists($user->foto_profil)) {
                Storage::delete($user->foto_profil);
            }

            // Simpan foto baru
            $path = $image->store('foto_profil', 'public');

            // Simpan path ke database
            $user->foto_profil = $path;
        }

        // Simpan semua perubahan
        $user->save();

        return redirect()->route('user.dashboard')->with('success', 'Profil berhasil diperbarui!');
    }

 public function updatePassword(Request $request, $id)
{
    // Ambil user yang sedang login
    $user = User::findOrFail($id);

    // Validasi input
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
        // Pesan validasi lain bisa ditambah di sini
    ]);

    // Cek apakah password lama sesuai
    if (!Hash::check($request->currentPassword, $user->password)) {
        return back()->withErrors(['currentPassword' => 'Kata sandi lama salah.']);
    }

    // Simpan password baru
    $user->password = Hash::make($request->newPassword);
    $user->save();

    // Redirect dengan pesan sukses
    return redirect()->route('user.edit', $user->id)->with('success', 'Kata sandi berhasil diubah!');
}

}