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
    function manager_modify_post_vehicle()
    {
        $manager = $this->newManager();
        $vehicleData = factory(Vehicle::class)->make([
            'client_id' => factory(Client::class)->create()->id
        ])->toArray();
        $this->actingAs($manager);
        $response = $this->post(route('vehicle.create', $vehicleData));
        $response->assertStatus(302);
        $this->assertDatabaseHas('vehicles', $vehicleData);
    }
}
