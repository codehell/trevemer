<?php

namespace Tests\Feature\Auth;

use Cawoch\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EditUsersTest extends TestCase
{

    use DatabaseTransactions;

    /**
     * Test a user can access to his edit profile form
     * @test
     */
    function edit_user_profile_access_test()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('user.edit'))
            ->assertStatus(200)
            ->assertSee($user->email);
    }

    /** @test */
    function a_user_can_edit_his_profile()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        $response = $this->post(route('user.edit'), [
            'name' => 'codehell',
            'email'=> 'admin@codehell.net',
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ]);

        $this->seeCredentials([
            'name' => 'codehell',
            'email'=> 'admin@codehell.net',
            'password' => 'secret',
        ]);

        $response->assertRedirect('home');
    }

    /** @test */
    function admin_can_access_users_profiles()
    {
        $user = $this->newAdmin();

        $this->actingAs($user)
            ->get(route('user.edit'))
            ->assertStatus(200);
    }
}
