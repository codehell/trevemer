<?php

namespace Tests\Feature\Clients;

use Cawoch\Client;
use Cawoch\Phone;
use Cawoch\User;
use Cawoch\Vehicle;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ClientsListTest extends TestCase
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
    function search_clients()
    {
        $clients = factory(Client::class)->times(60)->create()->each(function ($c) {
            $c->phones()->save(factory(Phone::class)->make());
        });

        $user = factory(User::class)->create();
        factory(Client::class, 1)->create([
            'id_card' => '44850555M',
            'email' => 'faker@ggmail.com',
        ])->each(function ($c) {
            $c->phones()->save(factory(Phone::class)->make());
            $c->vehicles()->save(factory(Vehicle::class)->make([
                'plate' => '1234 ABC'
            ]));
        });

        $this->actingAs($user)
            ->get(route('client.index', ['search' => '44850555M']))
            ->assertStatus(200)
            ->assertSee('faker@ggmail.com');

        $this->get(route('client.index', ['search' => '1234 ABC']))
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
