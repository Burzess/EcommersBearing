<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OwnerReportAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_can_access_report_page(): void
    {
        $role = Role::create([
            'name' => 'owner',
            'display_name' => 'Owner',
            'description' => 'Owner role',
        ]);

        $owner = User::factory()->create([
            'role_id' => $role->id,
        ]);

        $response = $this->actingAs($owner)->get(route('owner.laporan-pendapatan.index'));

        $response->assertOk();
        $response->assertSee('Laporan Pendapatan');
    }

    public function test_guest_is_redirected_to_login(): void
    {
        $response = $this->get(route('owner.laporan-pendapatan.index'));

        $response->assertRedirect(route('login'));
    }

    public function test_non_owner_is_forbidden(): void
    {
        $role = Role::create([
            'name' => 'pelanggan',
            'display_name' => 'Pelanggan',
            'description' => 'Pelanggan role',
        ]);

        $user = User::factory()->create([
            'role_id' => $role->id,
        ]);

        $response = $this->actingAs($user)->get(route('owner.laporan-pendapatan.index'));

        $response->assertForbidden();
    }
}
