<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = [
            [
                'nama' => 'Ball Bearing',
                'deskripsi' => 'Bearing bola untuk berbagai aplikasi industri',
                'icon' => 'bi-circle',
                'urutan' => 1,
            ],
            [
                'nama' => 'Roller Bearing',
                'deskripsi' => 'Bearing roller untuk beban berat',
                'icon' => 'bi-cylinder',
                'urutan' => 2,
            ],
            [
                'nama' => 'Thrust Bearing',
                'deskripsi' => 'Bearing untuk beban aksial',
                'icon' => 'bi-arrows-expand',
                'urutan' => 3,
            ],
            [
                'nama' => 'Needle Bearing',
                'deskripsi' => 'Bearing jarum untuk ruang terbatas',
                'icon' => 'bi-pin-angle',
                'urutan' => 4,
            ],
            [
                'nama' => 'Plain Bearing',
                'deskripsi' => 'Bearing polos untuk aplikasi khusus',
                'icon' => 'bi-square',
                'urutan' => 5,
            ],
            [
                'nama' => 'Angular Contact Bearing',
                'deskripsi' => 'Bearing untuk beban kombinasi radial dan aksial',
                'icon' => 'bi-arrow-up-right',
                'urutan' => 6,
            ],
        ];

        foreach ($kategoris as $kategori) {
            Kategori::create($kategori);
        }
    }
}
