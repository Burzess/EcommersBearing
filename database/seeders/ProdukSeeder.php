<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;
use App\Models\ProdukImage;
use Faker\Factory as Faker;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        
        $materials = ['Steel', 'Ceramic', 'Stainless Steel', 'Chrome Steel'];
        $sealTypes = ['Open', 'Sealed', 'Shielded', '2RS', 'ZZ'];
        $cageTypes = ['Steel', 'Brass', 'Nylon', 'Polyamide'];
        
        // Buat 50 produk
        for ($i = 1; $i <= 50; $i++) {
            $harga = $faker->numberBetween(50000, 500000);
            $diskon = $faker->boolean(30) ? $harga - ($harga * $faker->numberBetween(5, 30) / 100) : null;
            
            $produk = Produk::create([
                'kategori_id' => $faker->numberBetween(1, 6),
                'merk_id' => $faker->numberBetween(1, 8),
                'nama' => 'Bearing ' . $faker->bothify('??-####'),
                'sku' => 'BRG-' . str_pad($i, 5, '0', STR_PAD_LEFT),
                'deskripsi' => $faker->paragraph(3),
                'harga' => $harga,
                'harga_diskon' => $diskon,
                'stok' => $faker->numberBetween(0, 100),
                'min_stok' => 5,
                'berat' => $faker->randomFloat(2, 10, 1000),
                'unit' => 'pcs',
                'is_featured' => $faker->boolean(20),
                'is_active' => $faker->boolean(95),
                'inner_diameter' => $faker->randomFloat(2, 5, 100),
                'outer_diameter' => $faker->randomFloat(2, 10, 200),
                'width' => $faker->randomFloat(2, 5, 50),
                'material' => $faker->randomElement($materials),
                'seal_type' => $faker->randomElement($sealTypes),
                'cage_type' => $faker->randomElement($cageTypes),
                'views' => $faker->numberBetween(0, 1000),
                'sold_count' => $faker->numberBetween(0, 100),
            ]);
            
            // Buat 1-3 gambar untuk setiap produk
            $imageCount = $faker->numberBetween(1, 3);
            for ($j = 1; $j <= $imageCount; $j++) {
                ProdukImage::create([
                    'produk_id' => $produk->id,
                    'image_path' => 'produk/default-bearing.jpg',
                    'is_primary' => $j === 1,
                    'urutan' => $j,
                ]);
            }
        }
    }
}
