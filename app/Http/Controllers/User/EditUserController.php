<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
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

    private function authorizeUser(User $user)
    {
        if (Auth::id() != $user->id) {
            abort(403);
        }
    }

    public function edit(User $user){
        $this->authorizeUser($user);
        return view('user.editprofil', compact('user'));
    }

    public function update(UpdateProfileRequest $request, User $user)
    {
        $this->authorizeUser($user);
        $data = $request->validated();
        if ($request->hasFile('foto_profil')) {
            if ($user->foto_profil && $user->foto_profil !== 'fotoprofil.jpg' && Storage::disk('public')->exists($user->foto_profil)) {
                Storage::disk('public')->delete($user->foto_profil);
            }
            $data['foto_profil'] = $request->file('foto_profil')->store('foto_profil', 'public');
        }
        $user->update($data);
        Auth::login($user);
        return redirect()->route('user.dashboard')->with('success', 'Profil berhasil diperbarui!');
    }

    public function updatePassword(Request $request, User $user)
    {
        $this->authorizeUser($user);
        try{
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
        }
        catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->with('showPasswordModal', true);
        }

        if (!Hash::check($request->currentPassword, $user->password)) {
            return back()->withErrors(['currentPassword' => 'Kata sandi lama salah.'])->with('showPasswordModal', true);
        }

        $user->password = Hash::make($request->newPassword);
        $user->save();


        return redirect()->route('user.edit', $user->id)->with('success', 'Kata sandi berhasil diubah!');
    }

}