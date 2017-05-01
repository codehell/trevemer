<?php

namespace Tests\Feature\Clients;

use Cawoch\Client;
use Cawoch\Phone;
use Cawoch\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ListClientsTest extends TestCase
{
    use DatabaseTransactions;

    /** @test   */
    function user_list_clients()
    {
        $clients = factory(Client::class)->times(60)->create()->each(function ($c) {
            $c->phones()->save(factory(Phone::class)->make());
        })->sortByDesc('id');

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
    function user_search_clients_by_id_card()
    {
        $clients = factory(Client::class)->times(60)->create()->each(function ($c) {
            $c->phones()->save(factory(Phone::class)->make());
        });
        factory(Client::class, 1)->create([
            'id_card' => '44850555M',
            'email' => 'faker@ggmail.com'
        ])->each(function ($c) {
            $c->phones()->save(factory(Phone::class)->make());
        });
        $random = $clients->random();
        $this->actingAs(factory(User::class)->create())
            ->get(route('client.index', ['search' => '44850555M']))
            ->assertStatus(200)
            ->assertSee('faker@ggmail.com');

    }

    /** @test */
    function guest_user_cant_list_clients()
    {
        $this->get(route('client.index'))
            ->assertRedirect('login');
    }
}
