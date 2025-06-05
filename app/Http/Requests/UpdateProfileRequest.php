<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return Auth::id() === $this->route('user')->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->route('user')->id;
        return [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $userId,
            'whatsapp' => ['nullable', 'string', 'regex:/^62\d{8,13}$/'],
            'instagram' => 'nullable|string',
            'alamat' => 'required|string',
            'bio' => 'nullable|string',
            'foto_profil' => 'nullable|image|max:2048', 
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email sudah digunakan',
            'alamat.required' => 'Alamat wajib diisi',
            'whatsapp.regex' => 'Nomor Whatsapp dimulai dengan kode negara (ex:6281234567)',
            'foto_profil.image' => 'Foto profil harus berupa gambar',
            'foto_profil.max' => 'Ukuran foto profil maksimal 2MB',
        ];
    }
}
