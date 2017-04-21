<?php

namespace Tests;

use Cawoch\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function newAdmin()
    {
        return factory(User::class)->create([
            'role' => 'admin',
        ]);
    }

    protected function newManager()
    {
        return factory(User::class)->create([
            'role' => 'manager',
        ]);
    }

    protected function clientData($data = [])
    {
        $client =  [
            'first_name' => 'Pepe',
            'last_name' => 'Perez',
            'snd_last_name' => 'Cuesta',
            'id_card' => '44444444A',
            'mobile' => '650900000',
            'phones' => '963111111 666554433',
            'address' => 'Calle Humanista Centollo 1-A',
            'postal_code' => '46018',
            'email' => 'client@dominio.loc',
            'car_plate' => '4567ABC',
            'note' => 'Cliente muy exigente pero que no pone pegas en cuanto a los presupuestos'
        ];
        if (count($data) != 0) {
            foreach ($data as $row => $datum) {
                $client[$row] = $datum;
            }
        }
        return $client;
    }
}
