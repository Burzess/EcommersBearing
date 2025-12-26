<?php

namespace Database\Seeders;

use App\Models\Kontak;
use Illuminate\Database\Seeder;

class KontakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kontak::create([
            'nama_perusahaan' => 'Bearing Shop',
            'alamat' => 'Jl. Industri Bearing No. 123, Kelurahan Sukamaju, Kecamatan Industri, Surabaya, Jawa Timur 60123, Indonesia',
            'telepon' => '+62 31 123 4567',
            'whatsapp' => '+62 812 3456 7890',
            'email' => 'info@bearingshop.com',
            'jam_operasional' => 'Senin - Jumat: 08:00 - 17:00 WIB, Sabtu: 08:00 - 14:00 WIB, Minggu & Hari Libur: Tutup',
            'google_maps_embed' => null,
            'facebook' => 'https://facebook.com/bearingshop',
            'instagram' => 'https://instagram.com/bearingshop',
            'twitter' => null,
            'is_active' => true,
        ]);
    }
}
