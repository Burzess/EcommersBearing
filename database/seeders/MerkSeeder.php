<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Merk;

class MerkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $merks = [
            [
                'nama' => 'SKF',
                'deskripsi' => 'Merk bearing premium dari Swedia',
                'is_premium' => true,
            ],
            [
                'nama' => 'NSK',
                'deskripsi' => 'Merk bearing premium dari Jepang',
                'is_premium' => true,
            ],
            [
                'nama' => 'NTN',
                'deskripsi' => 'Merk bearing berkualitas dari Jepang',
                'is_premium' => false,
            ],
            [
                'nama' => 'FAG',
                'deskripsi' => 'Merk bearing premium dari Jerman',
                'is_premium' => true,
            ],
            [
                'nama' => 'Timken',
                'deskripsi' => 'Merk bearing berkualitas dari Amerika',
                'is_premium' => false,
            ],
            [
                'nama' => 'INA',
                'deskripsi' => 'Merk bearing dari Jerman',
                'is_premium' => false,
            ],
            [
                'nama' => 'KOYO',
                'deskripsi' => 'Merk bearing dari Jepang',
                'is_premium' => false,
            ],
            [
                'nama' => 'NACHI',
                'deskripsi' => 'Merk bearing dari Jepang',
                'is_premium' => false,
            ],
        ];

        foreach ($merks as $merk) {
            Merk::create($merk);
        }
    }
}
