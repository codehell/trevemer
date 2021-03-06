<?php

namespace Tests\Feature\Clients;

use Cawoch\Client;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EditClientTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    function a_manager_can_edit_a_client()
    {
        $manager = $this->newManager();
        $client = factory(Client::class)->create();

        $this->actingAs($manager)
            ->get(route('client.edit', $client))
            ->assertStatus(200)
            ->assertSee($client->first_name);
    }

    /** @test */
    function a_manager_can_modify_a_client_data()
    {
        $data = $this->clientData();

        $modified = [
            'first_name' => 'Jose',
            'last_name' => 'Perez',
            'snd_last_name' => 'Cuesta',
            'id_card' => '54444444B',
            'address' => 'Calle Humanista Centollo 1-B',
            'email' => 'client@dominio.lo',
            'note' => 'Cliente nada exigente pero que pone pegas en cuanto a los presupuestos'
        ];

        $manager = $this->newManager();
        $client = factory(Client::class)->create($data);

        $this->actingAs($manager);

        $response = $this->post(route('client.edit', $client), $modified);
        $this->assertDatabaseHas('clients', $modified);

        $response->assertRedirect(route('client.edit', $client))
            ->assertSessionHas('success', __('app.client.update_success', ['name' => $client->fresh()->name]));
    }

    /** @test */
    function add_phone_to_client()
    {
        $user = $this->newManager();

        $client = factory(Client::class)->create();
        $this->actingAs($user)
            ->post(route('phone.create', $client), ['phone' => '963777777']);
        $this->assertDatabaseHas('phones', [
            'number' => '963777777',
            'client_id' => $client->id,
        ]);
    }
}
