<?php

namespace Database\Seeders;

use App\Models\TentangKami;
use Illuminate\Database\Seeder;

class TentangKamiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TentangKami::create([
            'judul' => 'Tentang Bearing Shop',
            'konten' => 'Bearing Shop adalah toko bearing terpercaya yang telah melayani kebutuhan industri Indonesia sejak 2020. Kami menyediakan berbagai jenis bearing dari brand ternama dunia seperti SKF, NSK, NTN, FAG, dan NACHI.

Dengan pengalaman lebih dari 10 tahun di industri bearing, kami berkomitmen untuk memberikan produk original berkualitas tinggi dengan harga yang kompetitif.

Kenapa Memilih Kami?

- Produk 100% Original dengan garansi resmi
- Harga kompetitif untuk semua segmen
- Pengiriman cepat ke seluruh Indonesia
- Tim support yang responsif dan profesional
- Layanan konsultasi teknis gratis

Kami melayani berbagai sektor industri termasuk manufaktur, pertambangan, pertanian, otomotif, dan masih banyak lagi. Kepuasan pelanggan adalah prioritas utama kami.',
            'gambar' => null,
            'visi' => 'Menjadi penyedia bearing terpercaya dan terlengkap di Indonesia dengan layanan terbaik dan harga kompetitif.',
            'misi' => 'Menyediakan produk bearing original berkualitas tinggi
Memberikan layanan pelanggan yang profesional dan responsif
Membangun kemitraan jangka panjang dengan pelanggan
Terus berinovasi dalam layanan dan teknologi
Menjaga kepercayaan pelanggan dengan integritas tinggi',
            'is_active' => true,
        ]);
    }
}
