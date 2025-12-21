<?php

namespace Database\Seeders;

use App\Models\KebijakanPrivasi;
use Illuminate\Database\Seeder;

class KebijakanPrivasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'judul' => 'Pendahuluan',
                'isi' => 'Bearing Shop berkomitmen untuk melindungi privasi Anda. Kebijakan Privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi pribadi Anda saat menggunakan layanan kami.'
            ],
            [
                'judul' => 'Informasi yang Kami Kumpulkan',
                'isi' => 'Kami mengumpulkan informasi yang Anda berikan secara langsung kepada kami, termasuk:
- Nama lengkap
- Alamat email
- Nomor telepon
- Alamat pengiriman
- Informasi pembayaran'
            ],
            [
                'judul' => 'Penggunaan Informasi',
                'isi' => 'Kami menggunakan informasi yang dikumpulkan untuk:
- Memproses dan mengirimkan pesanan Anda
- Menghubungi Anda terkait pesanan
- Mengirimkan informasi promosi (dengan persetujuan Anda)
- Meningkatkan layanan kami
- Menjawab pertanyaan dan memberikan dukungan pelanggan'
            ],
            [
                'judul' => 'Keamanan Data',
                'isi' => 'Kami menerapkan langkah-langkah keamanan yang tepat untuk melindungi informasi pribadi Anda dari akses, penggunaan, atau pengungkapan yang tidak sah. Data Anda dilindungi dengan enkripsi SSL dan sistem keamanan berlapis.'
            ],
            [
                'judul' => 'Berbagi Informasi',
                'isi' => 'Kami tidak menjual atau menyewakan informasi pribadi Anda kepada pihak ketiga. Kami hanya berbagi informasi dengan pihak ketiga yang diperlukan untuk memproses pesanan Anda, seperti jasa pengiriman.'
            ],
            [
                'judul' => 'Perubahan Kebijakan',
                'isi' => 'Kami dapat memperbarui Kebijakan Privasi ini dari waktu ke waktu. Perubahan akan diumumkan di halaman ini dan tanggal pembaruan terakhir akan ditampilkan.'
            ],
            [
                'judul' => 'Hubungi Kami',
                'isi' => 'Jika Anda memiliki pertanyaan tentang Kebijakan Privasi ini atau ingin mengajukan permintaan terkait data pribadi Anda, silakan hubungi kami melalui halaman Kontak atau email ke info@bearingshop.com'
            ],
        ];

        KebijakanPrivasi::create([
            'judul' => 'Kebijakan Privasi',
            'konten' => json_encode($items),
            'tanggal_berlaku' => now(),
            'is_active' => true,
        ]);
    }
}
