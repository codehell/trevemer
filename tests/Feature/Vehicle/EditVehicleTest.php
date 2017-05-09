<?php

namespace Tests\Feature\Vehicle;

use Cawoch\Client;
use Cawoch\Vehicle;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EditVehicleTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    function manager_can_edit_a_new_vehicle()
    {
        $vehicle = factory(Vehicle::class)->create([
            'client_id' => factory(Client::class)->create()->id
        ]);
        $manager = $this->newManager();
        $this->actingAs($manager)
            ->get(route('vehicle.edit', $vehicle))
            ->assertStatus(200)
            ->assertSee(trans('app.vehicle.edit_title'));
    }

    /** @test */
    function modify_kilometers_of_vehicle()
    {
        $manager = $this->newManager();
        $vehicle = factory(Vehicle::class)->create([
            'client_id' => factory(Client::class)->create()->id,
            'kilometers' => '100000'
        ]);
        $vehicleData = $vehicle->toArray();

        $vehicleData['kilometers'] = '150000';

        $this->actingAs($manager);
        $response = $this->put(route('vehicle.edit', $vehicle), $vehicleData);
        $response->assertStatus(302);
        $this->assertDatabaseHas('vehicles', $vehicleData);
    }

    /** @test */
    function owner_must_exist()
    {
        $manager = $this->newManager();
        $client = factory(Client::class)->create();
        $vehicle = factory(Vehicle::class)->create([
            'client_id' => $client->id,
            'kilometers' => '100000'
        ]);
        $vehicleData = $vehicle->toArray();

        $vehicleData['client_id'] = ++$client->id;

        $this->actingAs($manager);
        $response = $this->put(route('vehicle.edit', $vehicle), $vehicleData);
        $response->assertStatus(302)
            ->assertSessionHasErrors('client_id', 'The selected client id is invalid');
    }
}
