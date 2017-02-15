<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegisterUserTest extends TestCase
{
    use DatabaseTransactions;

    /** @test    */
    function a_manager_can_register_a_new_user()
    {
        $admin = $this->newAdmin();


        $this->actingAs($admin)
            ->get(route('register'))
            ->assertStatus(200);


        $response = $this->post(route('register'), [
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
