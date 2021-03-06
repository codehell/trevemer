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
            ->assertSee(trans('app.vehicle.create_title'));
    }

    /** @test */
    function register_a_new_vehicle()
    {
        $manager = $this->newManager();
        $vehicleData = factory(Vehicle::class)->make([
            'client_id' => factory(Client::class)->create()->id
        ])->toArray();
        $this->actingAs($manager);
        $response = $this->post(route('vehicle.create'), $vehicleData)
            ->assertStatus(302);
        $this->assertDatabaseHas('vehicles', $vehicleData);
        $vehicle = Vehicle::where('plate', $vehicleData['plate'])->first();
        $response->assertRedirect(route('vehicle.show', $vehicle));
    }

    /** @test */
    function vehicle_serial_must_be_unique()
    {
        $manager = $this->newManager();
        $client = factory(Client::class)->create();
        $vehicle = factory(Vehicle::class)->create([
            'client_id' => $client->id
        ]);
        $another_vehicle = factory(Vehicle::class)->make([
            'serial' => $vehicle->serial
        ]);
        $this->actingAs($manager);
        $response = $this->post(route('vehicle.create'), $another_vehicle->toArray())
            ->assertStatus(302);
        $response->assertSessionHasErrors('serial', 'The serial has already been taken.');
    }
}
