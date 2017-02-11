<?php

namespace Tests\Feature\Clients;

use Cawoch\Client;
use Cawoch\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateClientTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function a_user_can_create_a_client()
    {
        $user = factory(User::class)->create();

        $data = [
            'first_name' => 'Pepe',
            'last_name' => 'Perez',
            '2nd_last_name' => 'Cuesta',
            'phone'     => '963711111',
            'mobile'    => '650900000',
            'address'   => 'Calle Humanista Centollo 1-A',
            'email'     => 'client@dominio.loc',
            'notes'     => 'Cliente muy exigente pero que no pone pegas en cuanto a los presupuestos'
        ];

        $this->actingAs($user)
            ->get('client/create')
            ->assertStatus(200);

        $response = $this->post('client/create', $data);

        $this->assertDatabaseHas('clients', $data);

        $client = Client::where('email', 'client@dominio.loc')->first();

        $response->assertRedirect(route('order.create', $client));
    }
}
