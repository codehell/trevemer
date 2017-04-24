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
    function a_manager_can_post_a_new_client()
    {
        $user = $this->newManager();

        $data = $this->clientData();

        $this->actingAs($user);

        $response = $this->post(route('client.create'), $data);

        $this->assertDatabaseHas('clients', $data);

        $client = Client::where('email', 'client@dominio.loc')->first();

        $response->assertRedirect(route('order.create', $client));
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

    /** @test */
    function phone_are_required_if_mobile_is_not_present()
    {
        $manager = $this->newManager();

        $this->actingAs($manager);

        $data = $this->clientData();
        $data['phone'] = '';
        $data['mobile'] = '';

        $this->post(route('client.create'), $data);

        $this->assertEquals(
            'The phone field is required when mobile is not present.',
            session()->get('errors')->first('phone')
        );
    }
}
