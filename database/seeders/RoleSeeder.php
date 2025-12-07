<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'id' => 1,
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'Administrator dengan akses penuh ke sistem',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'pelanggan',
                'display_name' => 'Pelanggan',
                'description' => 'Pelanggan yang dapat melakukan pembelian',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
