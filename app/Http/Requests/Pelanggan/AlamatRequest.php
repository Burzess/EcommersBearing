<?php

namespace App\Http\Requests\Pelanggan;

use Illuminate\Foundation\Http\FormRequest;

class AlamatRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'label' => ['required', 'string', 'max:50'],
            'penerima' => ['required', 'string', 'max:255'],
            'telepon' => ['required', 'string', 'max:20'],
            'alamat_lengkap' => ['required', 'string'],
            'provinsi' => ['required', 'string', 'max:100'],
            'kota' => ['required', 'string', 'max:100'],
            'kecamatan' => ['required', 'string', 'max:100'],
            'kode_pos' => ['required', 'string', 'max:10'],
        ];
    }

    public function messages(): array
    {
        return [
            'label.required' => 'Label alamat wajib diisi (contoh: Rumah, Kantor)',
            'penerima.required' => 'Nama penerima wajib diisi',
            'telepon.required' => 'Nomor telepon wajib diisi',
            'alamat_lengkap.required' => 'Alamat lengkap wajib diisi',
            'provinsi.required' => 'Provinsi wajib dipilih',
            'kota.required' => 'Kota wajib dipilih',
            'kecamatan.required' => 'Kecamatan wajib dipilih',
            'kode_pos.required' => 'Kode pos wajib diisi',
        ];
    }
}
