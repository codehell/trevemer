<?php

namespace Tests\Feature\Auth;

use Cawoch\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EditUsersTest extends TestCase
{

    use DatabaseTransactions;

    /** @test */
    function a_user_can_edit_his_profile()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('user.edit'))
            ->assertStatus(200)
            ->assertSee($user->email);

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
}
