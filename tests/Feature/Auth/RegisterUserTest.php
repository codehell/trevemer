<?php

namespace Tests\Feature\Auth;

use Cawoch\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegisterUserTest extends TestCase
{
    use DatabaseTransactions;

    /** @test    */
    function a_admin_can_register_a_new_user()
    {
        $user = $this->newAdmin();

        // admin can access to route
        $this->actingAs($user)
            ->get(route('register'))
            ->assertStatus(200);

        // when
        $response = $this->post(route('register'), [
            'name' => 'codehell',
            'email'=> 'admin@codehell.net',
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ]);

        // then
        $this->seeCredentials([
            'name' => 'codehell',
            'email'=> 'admin@codehell.net',
            'password' => 'secret',
        ]);

        $response->assertRedirect('home');

    }

    /** @test */
    function a_manager_cant_register_a_new_user()
    {
        $this->actingAs($this->newManager());
        // When
        $response = $this->post(route('register'), [
            'name' => 'codehell',
            'email'=> 'admin@codehell.net',
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ]);
        // Then
        $response->assertStatus(403);
    }

    /** @test */
    function a_user_cant_register_a_new_user()
    {
        $this->actingAs(factory(User::class)->create());
        // When
        $response = $this->post(route('register'), [
            'name' => 'codehell',
            'email'=> 'admin@codehell.net',
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ]);
        // Then
        $response->assertStatus(403);
    }

    /** @test */
    function a_guest_cant_register_a_new_user()
    {
        // When
        $response = $this->post(route('register'), [
            'name' => 'codehell',
            'email'=> 'admin@codehell.net',
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ]);

        $this->assertDatabaseMissing('users', [
            'name' => 'codehell',
        ]);

        // Then
        $response->assertRedirect('login');
    }
}
