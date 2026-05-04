<?php

namespace Tests\Feature;

use App\Models\Alamat;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ShippingAndWilayahTest extends TestCase
{
    use RefreshDatabase;

    public function test_surabaya_shipping_becomes_free_at_threshold(): void
    {
        Cache::flush();

        $role = Role::create([
            'name' => 'pelanggan',
            'display_name' => 'Pelanggan',
            'description' => 'Pelanggan role',
        ]);

        $user = User::factory()->create([
            'role_id' => $role->id,
        ]);
        $alamat = Alamat::create([
            'user_id' => $user->id,
            'label' => 'Rumah',
            'penerima' => 'Budi Santoso',
            'telepon' => '081234567890',
            'alamat_lengkap' => 'Jl. Tunjungan No. 1',
            'provinsi' => 'JAWA TIMUR',
            'kota' => 'Surabaya',
            'kecamatan' => 'Genteng',
            'kode_pos' => '60275',
            'is_default' => true,
        ]);

        $response = $this->actingAs($user)->postJson(route('api.ongkir.hitung-by-alamat'), [
            'alamat_id' => $alamat->id,
            'subtotal' => 150000,
        ]);

        $response->assertOk();
        $response->assertJsonPath('success', true);
        $response->assertJsonPath('data.tarif', 0);
        $response->assertJsonPath('data.is_free_shipping', true);
    }

    public function test_wilayah_proxy_returns_kode_nama_shape(): void
    {
        Cache::flush();

        Http::fake([
            'https://wilayah.id/api/provinces.json' => Http::response([
                'data' => [
                    ['code' => '35', 'name' => 'JAWA TIMUR'],
                    ['code' => '31', 'name' => 'DKI JAKARTA'],
                ],
            ], 200),
        ]);

        $response = $this->getJson(route('api.wilayah.provinsi'));

        $response->assertOk();
        $response->assertJson([
            ['kode' => '35', 'nama' => 'JAWA TIMUR'],
            ['kode' => '31', 'nama' => 'DKI JAKARTA'],
        ]);
    }
}