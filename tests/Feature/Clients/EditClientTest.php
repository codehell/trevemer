<?php

namespace Tests\Feature\Clients;

use Cawoch\Client;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EditClientTest extends TestCase
{
    use DatabaseTransactions;
    /** @test */
    public function a_admin_can_edit_a_client()
    {
        $data = [
            'first_name' => 'Pepe',
            'last_name' => 'Perez',
            'snd_last_name' => 'Cuesta',
            'phone'     => '963711111',
            'mobile'    => '650900000',
            'address'   => 'Calle Humanista Centollo 1-A',
            'email'     => 'client@dominio.loc',
            'note'     => 'Cliente muy exigente pero que no pone pegas en cuanto a los presupuestos'
        ];

        $modified = [
            'first_name' => 'Jose',
            'last_name' => 'Perez',
            'snd_last_name' => 'Cuesta',
            'phone'     => '963711111',
            'mobile'    => '650900000',
            'address'   => 'Calle Humanista Centollo 1-A',
            'email'     => 'client@dominio.loc',
            'note'     => 'Cliente muy exigente pero que no pone pegas en cuanto a los presupuestos'
        ];

        $admin = $this->newAdmin();
        $client = factory(Client::class)->create($data);
        $this->actingAs($admin)
            ->get(route('client.edit', $client))
            ->assertStatus(200)
            ->assertSee($client->first_name);

        $response = $this->post(route('client.edit', $client), $modified);
        $this->assertDatabaseHas('clients', $modified);

        $response->assertRedirect(route('client.edit', $client))
            ->assertSessionHas('success', __('app.client.update_success', ['name' => $client->fresh()->name]));
    }
}
