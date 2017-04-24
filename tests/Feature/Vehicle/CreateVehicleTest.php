<?php

namespace Tests\Feature\Vehicle;

use Cawoch\Client;
use Cawoch\Vehicle;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateVehicleTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    function manager_can_register_a_new_vehicle()
    {
        $manager = $this->newManager();
        $this->actingAs($manager)
            ->get(route('vehicle.create'))
            ->assertStatus(200)
            ->assertSee('Vehicle registration page');
    }

    /** @test */
    function manager_can_post_a_new_vehicle()
    {
        $manager = $this->newManager();
        $vehicleData = factory(Vehicle::class)->make()->toArray();
        $this->actingAs($manager);
        $redirect = $this->post(route('vehicle.create'), $vehicleData)
            ->assertStatus(302);
        $this->assertDatabaseHas('vehicles', $vehicleData);
        $vehicle = Vehicle::where('plate', $vehicleData['plate'])->first();
        $redirect->assertRedirect(route('vehicle.show', $vehicle));
    }
}
