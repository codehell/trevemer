<?php

use Cawoch\Client;
use Cawoch\Phone;
use Cawoch\Vehicle;
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
        factory(Client::class)->times(40)->create()->each(function ($c) {
            $c->phones()->save(factory(Phone::class)->make());
        })->sortByDesc('id');
    }
}
