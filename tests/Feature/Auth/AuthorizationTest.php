<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthorizationTest extends TestCase
{
    use DatabaseTransactions;

    /** @test  */
    function admin_can_do_actions_of_manager()
    {
        $admin = $this->newAdmin();
        $this->assertTrue($admin->can('manager'));
    }

    /** @test  */
    function manager_cant_do_actions_of_admin()
    {
        $manager = $this->newManager();
        $this->assertFalse($manager->can('admin'));
    }

    /** @test */
    function unregistered_user_cant_access_home()
    {
        $this->get('/home')
            ->assertRedirect('/login');
    }
}
