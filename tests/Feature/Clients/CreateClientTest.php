<?php

namespace Tests\Feature\Clients;

use Cawoch\Client;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateClientTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    function a_admin_can_create_a_client()
    {
        $user = $this->newAdmin();

        $data = [
            'first_name' => 'Pepe',
            'last_name' => 'Perez',
            '2nd_last_name' => 'Cuesta',
            'phone'     => '963711111',
            'mobile'    => '650900000',
            'address'   => 'Calle Humanista Centollo 1-A',
            'email'     => 'client@dominio.loc',
            'note'     => 'Cliente muy exigente pero que no pone pegas en cuanto a los presupuestos'
        ];

        $this->actingAs($user)
            ->get('client/create')
            ->assertStatus(200);

        $response = $this->post('client/create', $data);

        $this->assertDatabaseHas('clients', $data);

        $client = Client::where('email', 'client@dominio.loc')->first();

        $response->assertRedirect(route('order.create', $client));
    }

    /** @test */
    function a_non_admin_cant_create_a_client()
    {
        $this->post('client/create', [])
        ->assertRedirect('/login');
    }

    /** @test */
    function email_client_must_be_unique()
    {
        $user = $this->newAdmin();
        $client = factory(Client::class)->create([
            'email' => 'client@dominio.loc',
        ]);

        $data = [
            'first_name' => 'Pepe',
            'last_name' => 'Perez',
            '2nd_last_name' => 'Cuesta',
            'phone'     => '963711111',
            'mobile'    => '650900000',
            'address'   => 'Calle Humanista Centollo 1-A',
            'email'     => 'client@dominio.loc',
            'note'     => 'Cliente muy exigente pero que no pone pegas en cuanto a los presupuestos'
        ];

        $response = $this->actingAs($user)
            ->post(route('client.create'), $data);

        $veb = new ViewErrorBag();
        $mesb = new MessageBag(['email' => 'The email has already been taken.']);
        $veb->put('default', $mesb);

        $response->assertSessionHas('errors', $veb);
    }
}
