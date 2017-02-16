<?php

namespace Tests\Feature\Clients;

use Cawoch\Client;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ListClientsTest extends TestCase
{
    use DatabaseTransactions;

    /** @test   */
    function a_manager_can_list_clients()
    {
        $clients = factory(Client::class)->times(60)->create();

        $this->actingAs($this->newManager())
            ->get(route('client.index'))
            ->assertStatus(200)
            ->assertSee($clients->first()->first_name)
            ->assertSee($clients->slice(7,1)->first()->first_name)
            ->assertSee($clients->forPage(1, 15)->last()->first_name);

        $this->get(route('client.index', ['page' => '2']))
            ->assertStatus(200)
            ->assertSee($clients->forPage(2, 15)->first()->first_name);

        $this->get(route('client.index', ['page' => '3']))
            ->assertStatus(200)
            ->assertSee($clients->forPage(3, 15)->first()->first_name)
            ->assertSee($clients->forPage(3, 15)->last()->first_name);
    }
}
