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
}
