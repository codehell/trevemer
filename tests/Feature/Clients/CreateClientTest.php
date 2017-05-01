<?php

namespace Tests\Feature\Clients;

use Cawoch\User;
use Cawoch\Client;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateClientTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */

    function manager_can_register_a_client()
    {
        $user = $this->newManager();

        $this->actingAs($user)
            ->get('client/create')
            ->assertStatus(200);
    }

    /** @test */
    function manager_register_new_client()
    {
        $manager = $this->newManager();

        $data = factory(Client::class)->make()->toArray();

        $this->actingAs($manager);
        $data['phone'] = '913777777';

        $response = $this->post(route('client.create'), $data);

        unset($data['phone']);
        $this->assertDatabaseHas('clients', $data);
        $client = Client::first();
        $this->assertDatabaseHas('phones', [
            'client_id' => $client->id,
            'number' => '913777777'
        ]);

        $response->assertRedirect(route('client.show', $client));
    }


    /** @test */
    function a_user_cant_create_a_client()
    {
        $user = factory(User::class)->create([
            'role' => 'user',
        ]);

        $this->actingAs($user)
            ->post('client/create', [$this->clientData()])
            ->assertStatus(403);
    }

    /** @test */
    function id_card_must_be_unique()
    {
        $client = factory(Client::class)->create();
        $id_card = $client->id_card;
        $client_data = $this->clientData([
            'id_card' => $client->id_card,
        ]);
        $this->actingAs($this->newManager())
            ->post(route('client.create'), $client_data);

        $this->assertEquals(
            'The id card has already been taken.',
            session()->get('errors')->first('id_card')
        );
    }

    /** @test */
    function email_client_must_be_unique()
    {
        $user = $this->newManager();

        $client = factory(Client::class)->create([
            'email' => 'client@dominio.loc',
        ]);

        $this->actingAs($user);

        $this->post(route('client.create'), $this->clientData());

        $this->assertEquals(
            'The email has already been taken.',
            session()->get('errors')->first('email')
        );

    }
}
