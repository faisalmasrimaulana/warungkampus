<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|unique:users,nim',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'whatsapp' => 'required|string|regex:/^62\d{8,13}$/',
            'instagram' => 'nullable|string',
            'ktm' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'alamat' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return[
            'nama.required' => 'Nama wajib diisi',
            'nim.required' => 'NIM wajib diisi',
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
            'whatsapp.required' => 'Whatsapp wajib diisi',
            'ktm.required' => 'Foto KTM wajib diunggah',
            'email.email' => 'Format email salah, gunakan @',
            'email.unique' => 'Email sudah digunakan',
            'nim.unique' => 'NIM sudah digunakan',
            'ktm.max' => 'Ukuran foto maksimal 5 mb',
            'ktm.image' => 'File harus berupa foto',
            'alamat.required' => 'Alamat wajib diisi',
            'whatsapp.regex' => "Gunakan kode negara diawal (62)",
        ];
    }
}
