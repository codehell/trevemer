<?php

namespace Tests\Feature\Client;

use Cawoch\Client;
use Cawoch\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ShowClientTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    function a_user_can_view_client_data()
    {
        $user = factory(User::class)->create();
        $client = factory(Client::class)->create();
        $this->actingAs($user)
            ->get(route('client.show', $client))
            ->assertStatus(200);
    }
}
