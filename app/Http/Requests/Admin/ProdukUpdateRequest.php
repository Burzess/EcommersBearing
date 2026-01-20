<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProdukUpdateRequest extends FormRequest
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
        $produkId = $this->route('id');

        return [
            'kategori_id' => ['required', 'exists:kategoris,id'],
            'merk_id' => ['required', 'exists:merks,id'],
            'nama' => ['required', 'string', 'max:255'],
            'sku' => ['nullable', 'string', 'max:50', 'unique:produks,sku,' . $produkId],
            'harga' => ['required', 'numeric', 'min:0'],
            'harga_diskon' => ['nullable', 'numeric', 'min:0', 'lt:harga'],
            'stok' => ['required', 'integer', 'min:0'],
            'min_stok' => ['required', 'integer', 'min:0'],
            'berat' => ['required', 'numeric', 'min:0'],
            'deskripsi' => ['nullable', 'string'],
            'inner_diameter' => ['nullable', 'numeric', 'min:0'],
            'outer_diameter' => ['nullable', 'numeric', 'min:0'],
            'width' => ['nullable', 'numeric', 'min:0'],
            'material' => ['nullable', 'string', 'max:100'],
            'seal_type' => ['nullable', 'string', 'max:100'],
            'cage_type' => ['nullable', 'string', 'max:100'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
            'images' => ['nullable', 'array'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'kategori_id.required' => 'Kategori wajib dipilih',
            'merk_id.required' => 'Merk wajib dipilih',
            'nama.required' => 'Nama produk wajib diisi',
            'sku.unique' => 'SKU sudah digunakan',
            'harga.required' => 'Harga wajib diisi',
            'harga_diskon.lt' => 'Harga diskon harus lebih kecil dari harga normal',
            'stok.required' => 'Stok wajib diisi',
            'images.*.max' => 'Ukuran gambar maksimal 2MB',
        ];
    }
}
