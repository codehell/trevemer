<?php

use Cawoch\Client;
use Cawoch\Phone;
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
        factory(Client::class)->times(60)->create()->each(function ($c) {
            $c->phones()->save(factory(Phone::class)->make());
        })->sortByDesc('id');
    }
}
