<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PoliciesTest extends TestCase
{
    /** @test */
    public function unregistered_user_can_access_home()
    {
        $this->get('/home')
            ->assertRedirect('/login');
    }
}
