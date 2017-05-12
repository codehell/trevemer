<?php

namespace Tests\Feature\vehicle;

use Cawoch\Client;
use Cawoch\User;
use Cawoch\Vehicle;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VehiclesListTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function vehicles_list_paginate()
    {
        $vehicles = factory(Vehicle::class, 30)->create([
            'client_id' => factory(Client::class)->create()->id
        ])->sortByDesc('id');

        $this->actingAs(factory(User::class)->create())
            ->get(route('vehicle.index'))
            ->assertStatus(200)
            ->assertSee($vehicles->first()->serial)
            ->assertSee($vehicles->slice(7, 1)->first()->serial)
            ->assertSee($vehicles->forPage(1, 10)->last()->serial);

        $this->get(route('vehicle.index', ['page' => 2]))
            ->assertStatus(200)
            ->assertSee($vehicles->forPage(2, 10)->last()->serial);

        $this->get(route('vehicle.index', ['page' => 3]))
            ->assertStatus(200)
            ->assertSee($vehicles->forPage(3, 10)->first()->serial)
            ->assertSee($vehicles->forPage(3, 10)->last()->serial);
    }
}
