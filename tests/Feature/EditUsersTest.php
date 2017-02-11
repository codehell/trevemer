<?php

namespace Tests\Feature;

use Cawoch\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EditUsersTest extends TestCase
{

    use DatabaseTransactions;

    /** @test */
    public function a_user_can_edit_his_profile()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get(route('user.edit', $user))
            ->assertStatus(200)
            ->assertSee($user->email);

        $response = $this->post(route('user.edit', $user), [
            'name' => 'codehell',
            'email'=> 'admin@codehell.net',
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'codehell',
            'email'=> 'admin@codehell.net',
        ]);

        $response->assertRedirect('home');
    }
}
