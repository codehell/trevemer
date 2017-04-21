<?php

namespace Tests\Feature\Auth;

use Cawoch\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DeleteUserTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function admin_can_delete_a_user()
    {
        $admin = $this->newAdmin();
        $user = factory(User::class)->create([
            'name' => 'Codehell',
            'role' => 'user'
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'Codehell'
        ]);
        $this->actingAs($admin);

        $response = $this->delete(route('user.delete', ['user' => $user]));
        $response->assertStatus(302)
            ->assertSessionHas('success', 'The user Codehell was successfully deleted');
        $this->assertDatabaseMissing('users', [
            'name' => 'Codehell'
        ]);
    }
}
