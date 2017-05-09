<?php

use Illuminate\Database\Seeder;

class VehicleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = \Cawoch\Client::all();

        for ($i = 0; $i <= 40; $i++) {
            factory(\Cawoch\Vehicle::class)->create([
                'client_id' => $clients->random()->id
            ]);
        }
    }
}
