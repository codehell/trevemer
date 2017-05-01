<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 50; $i++) {
            $client = factory(\Cawoch\Client::class)->create();
            factory(\Cawoch\Phone::class)->create([
                'client_id' => $client->id
            ]);
        }

    }
}
