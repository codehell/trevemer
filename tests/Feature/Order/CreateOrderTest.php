<?php

namespace Tests\Feature\Order;

use Cawoch\Client;
use Cawoch\Vehicle;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateOrderTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function manager_can_create_a_order()
    {
        $manager = $this->newManager();
        $client = factory(Client::class)->create();
        $vehicle = factory(Vehicle::class)->create([
            'client_id' => $client->id
        ]);

        $this->actingAs($manager)
            ->get(route('order.create', $vehicle))
            ->assertStatus(200);
    }

    /** @test */
    public function order_creation()
    {
        $manager = $this->newManager();
        $client = factory(Client::class)->create();
        $vehicle = factory(Vehicle::class)->create([
            'client_id' => $client->id
        ]);

        $data = [

        ];
        $this->actingAs($manager)
            ->post(route('order.store'));
    }
}
