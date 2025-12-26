<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
     /**
      * Run the database seeds.
      */
     public function run(): void
     {
          // Admin User
          User::create([
               'role_id' => 1,
               'name' => 'Admin',
               'email' => 'admin@bearing.com',
               'password' => Hash::make('password'),
               'email_verified_at' => now(),
               'is_active' => true,
          ]);

          // Sample Pelanggan Users
          $pelanggan = [
               ['name' => 'Budi Santoso', 'email' => 'budi@example.com', 'telepon' => '081234567890'],
               ['name' => 'Siti Nurhaliza', 'email' => 'siti@example.com', 'telepon' => '081234567891'],
               ['name' => 'Ahmad Ridwan', 'email' => 'ahmad@example.com', 'telepon' => '081234567892'],
               ['name' => 'Dewi Lestari', 'email' => 'dewi@example.com', 'telepon' => '081234567893'],
               ['name' => 'Rudi Hermawan', 'email' => 'rudi@example.com', 'telepon' => '081234567894'],
          ];

          foreach ($pelanggan as $data) {
               User::create([
                    'role_id' => 2,
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'telepon' => $data['telepon'],
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                    'is_active' => true,
               ]);
          }
     }
}
