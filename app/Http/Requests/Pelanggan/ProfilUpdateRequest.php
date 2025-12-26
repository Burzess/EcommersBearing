<?php

namespace App\Http\Requests\Pelanggan;

use Illuminate\Foundation\Http\FormRequest;

class ProfilUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = auth()->id();
        
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,' . $userId],
            'telepon' => ['required', 'string', 'max:20'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'current_password' => ['required_with:password'],
            'notifikasi_email' => ['nullable', 'boolean'],
            'notifikasi_order' => ['nullable', 'boolean'],
            'notifikasi_promo' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.unique' => 'Email sudah digunakan',
            'telepon.required' => 'Nomor telepon wajib diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'current_password.required_with' => 'Password lama wajib diisi',
            'avatar.max' => 'Ukuran avatar maksimal 2MB',
        ];
    }
}
