<?php

namespace App\Http\Requests\Pelanggan;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'alamat_id' => ['required', 'exists:alamats,id'],
            'metode_pembayaran' => ['required', 'in:transfer,cod'],
            'kurir' => ['required', 'string', 'max:50'],
            'ongkir' => ['required', 'numeric', 'min:0'],
            'catatan' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'alamat_id.required' => 'Alamat pengiriman wajib dipilih',
            'alamat_id.exists' => 'Alamat tidak valid',
            'metode_pembayaran.required' => 'Metode pembayaran wajib dipilih',
            'metode_pembayaran.in' => 'Metode pembayaran tidak valid',
            'kurir.required' => 'Kurir wajib dipilih',
            'ongkir.required' => 'Ongkos kirim wajib diisi',
            'catatan.max' => 'Catatan maksimal 500 karakter',
        ];
    }
}
