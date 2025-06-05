<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class StoreProductRequest extends FormRequest
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
        'nama_produk' => 'required|string|max:255',
        'harga' => 'required|numeric|min:0',
        'kategori' => 'required|in:barang,jasa',
        'kondisi' => 'required_if:kategori,barang|string|nullable',
        'deskripsi_singkat' => 'required|string|max:100',
        'deskripsi_lengkap' => 'nullable|string',
        "productImages" => "required|array|max:5",
        'productImages.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            "nama_produk.required" => 'Nama Produk wajib diisi',
            "kategori.required" => 'Kategori wajib diisi',
            "harga.required" => 'Harga Produk wajib diisi',
            "deskripsi_singkat.required" => 'Deskripsi Singkat Produk wajib diisi',
            "kondisi.required" => 'Kondisi Produk wajib diisi',
            "productImages.required" => 'Foto Produk wajib diisi',
            "deskripsi_singkat.max" => 'Deskripsi hanya boleh 100 karakter',
            "productImages.max" => 'Maksimal hanya bisa upload 5 foto produk',
            "productImages.*.max" => 'Foto Produk maksimal 2 mb',
            'harga.numeric' => 'Harga harus berupa angka',
            'harga.min' => 'harga minimal 0 rupiah'
        ];
    }
}
