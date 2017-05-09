<?php

namespace Tests\Feature\Vehicle;

use Cawoch\User;
use Cawoch\Client;
use Cawoch\Vehicle;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ShowVehicleTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    function user_can_view_vehicle_data()
    {
        $user = factory(User::class)->create();
        $vehicle = factory(Vehicle::class)->create([
            'client_id' => factory(Client::class)->create()->id
        ]);

        $this->actingAs($user)
            ->get(route('vehicle.show', $vehicle))
            ->assertStatus(200)
            ->assertSee($vehicle->trademark)
            ->assertSee($vehicle->plate);
    }
}
