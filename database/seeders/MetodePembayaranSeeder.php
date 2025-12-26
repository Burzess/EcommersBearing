<?php

namespace Database\Seeders;

use App\Models\MetodePembayaran;
use Illuminate\Database\Seeder;

class MetodePembayaranSeeder extends Seeder
{
    public function run(): void
    {
        $metodePembayarans = [
            [
                'nama' => 'Transfer Bank BCA',
                'deskripsi' => 'Transfer via Bank BCA',
                'tipe' => 'transfer',
                'bank_nama' => 'BCA',
                'bank_rekening' => '1234567890',
                'bank_atas_nama' => 'PT Bearing Shop Indonesia',
                'instruksi' => "1. Transfer ke rekening BCA di atas\n2. Simpan bukti transfer\n3. Upload bukti transfer di halaman pesanan\n4. Pesanan akan diproses setelah pembayaran dikonfirmasi",
                'is_active' => true,
                'urutan' => 1,
            ],
            [
                'nama' => 'Transfer Bank BNI',
                'deskripsi' => 'Transfer via Bank BNI',
                'tipe' => 'transfer',
                'bank_nama' => 'BNI',
                'bank_rekening' => '0987654321',
                'bank_atas_nama' => 'PT Bearing Shop Indonesia',
                'instruksi' => "1. Transfer ke rekening BNI di atas\n2. Simpan bukti transfer\n3. Upload bukti transfer di halaman pesanan\n4. Pesanan akan diproses setelah pembayaran dikonfirmasi",
                'is_active' => true,
                'urutan' => 2,
            ],
            [
                'nama' => 'Transfer Bank Mandiri',
                'deskripsi' => 'Transfer via Bank Mandiri',
                'tipe' => 'transfer',
                'bank_nama' => 'Mandiri',
                'bank_rekening' => '1122334455',
                'bank_atas_nama' => 'PT Bearing Shop Indonesia',
                'instruksi' => "1. Transfer ke rekening Mandiri di atas\n2. Simpan bukti transfer\n3. Upload bukti transfer di halaman pesanan\n4. Pesanan akan diproses setelah pembayaran dikonfirmasi",
                'is_active' => true,
                'urutan' => 3,
            ],
            [
                'nama' => 'COD (Bayar di Tempat)',
                'deskripsi' => 'Pembayaran saat barang diterima',
                'tipe' => 'cod',
                'bank_nama' => null,
                'bank_rekening' => null,
                'bank_atas_nama' => null,
                'instruksi' => "1. Siapkan uang pas sesuai total pesanan\n2. Bayar kepada kurir saat barang diterima\n3. Pastikan cek kondisi barang sebelum membayar",
                'is_active' => true,
                'urutan' => 10,
            ],
        ];

        foreach ($metodePembayarans as $metode) {
            MetodePembayaran::updateOrCreate(
                ['nama' => $metode['nama']],
                $metode
            );
        }
    }
}
