<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class KategoriRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $kategoriId = $this->route('id');

        return [
            'nama' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'icon' => ['nullable', 'image', 'mimes:jpeg,png,jpg,svg', 'max:1024'],
            'urutan' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama kategori wajib diisi',
            'nama.max' => 'Nama kategori maksimal 255 karakter',
            'icon.image' => 'Icon harus berupa gambar',
            'icon.mimes' => 'Icon harus berformat: jpeg, png, jpg, atau svg',
            'icon.max' => 'Ukuran icon maksimal 1MB',
        ];
    }
}
