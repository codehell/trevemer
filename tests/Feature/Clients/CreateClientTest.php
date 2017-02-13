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
    function a_admin_can_create_a_client()
    {
        $user = $this->newAdmin();

        $data = $this->clientData();

        $this->actingAs($user)
            ->get('client/create')
            ->assertStatus(200);

        $response = $this->post('client/create', $data);

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
            ->post('client/create', [])
            ->assertStatus(403);
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

        $this->assertEquals('The email has already been taken.', session()->get('errors')->first('email'));

    }

    /** @test */
    function phone_or_mobile_fields_are_required()
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
