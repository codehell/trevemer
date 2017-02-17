<?php

namespace Tests\Feature\Clients;

use Cawoch\Client;
use Cawoch\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ListClientsTest extends TestCase
{
    use DatabaseTransactions;

    /** @test   */
    function a_user_can_list_clients()
    {
        $clients = factory(Client::class)->times(60)->create()->sortByDesc('id');

        $this->actingAs(factory(User::class)->create())
            ->get(route('client.index'))
            ->assertStatus(200)
            ->assertSee($clients->first()->id_card)
            ->assertSee($clients->slice(7,1)->first()->email)
            ->assertSee($clients->forPage(1, 15)->last()->id_card);

        $this->get(route('client.index', ['page' => '2']))
            ->assertStatus(200)
            ->assertSee($clients->forPage(2, 15)->first()->id_card);

        $this->get(route('client.index', ['page' => '3']))
            ->assertStatus(200)
            ->assertSee($clients->forPage(3, 15)->first()->id_card)
            ->assertSee($clients->forPage(3, 15)->last()->id_card);
    }

    /** @test */
    function a_user_can_search_clients_by_id_card()
    {
        $clients = factory(Client::class)->times(60)->create();
        $random = $clients->random();
        $this->actingAs(factory(User::class)->create())
            ->get(route('client.index', ['search' => $random->id_card]))
            ->assertStatus(200)
            ->assertSee($random->email);
    }

    /** @test */
    function guest_user_cant_list_clients()
    {
        $this->actingAs(factory(User::class)->create())
            ->get(route('client.index'))
            ->assertRedirect('login');
    }
}
