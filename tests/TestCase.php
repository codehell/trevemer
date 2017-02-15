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

    protected function clientData()
    {
        return [
            'first_name' => 'Pepe',
            'last_name' => 'Perez',
            'snd_last_name' => 'Cuesta',
            'id_card' => '44444444A',
            'phone'     => '963711111',
            'mobile'    => '650900000',
            'address'   => 'Calle Humanista Centollo 1-A',
            'email'     => 'client@dominio.loc',
            'note'     => 'Cliente muy exigente pero que no pone pegas en cuanto a los presupuestos'
        ];
    }
}
