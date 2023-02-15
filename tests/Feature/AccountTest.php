<?php

namespace LaravelersAcademy\ZoomMeeting\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use LaravelersAcademy\ZoomMeeting\Tests\TestCase;
use LaravelersAcademy\ZoomMeeting\Models\Account;

class AccountTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function testCreateAccount()
    {

        $data = [
            'account' => getenv('zoom_account'),
    		'client' => getenv('zoom_client'),
    		'secret' => getenv('zoom_secret'),
            'owner_id' => 1
        ];

        $this->postJson('/api/zoom/account/create', $data)
    		->assertStatus(201);

        $this->assertDatabaseHas('zoom_accounts', $data);

    }

    /** @test */
    public function testShowAccount()
    {
        $account = Account::factory()->create();

        $response = $this->getJson("/api/zoom/account/{$account->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'id' => $account->id,
                     'account' => $account->account,
                     'client' => $account->client,
                     'secret' => $account->secret,
                     'owner_id' => $account->owner_id,
                 ]);
    }

    /** @test */
    public function testUpdateAccount()
    {
        $account = Account::factory()->create();

        $data = [
            'account' => 'new_zoom_account',
            'client' => 'new_zoom_client',
            'secret' => 'new_zoom_secret',
            'owner_id' => 2
        ];

        $this->putJson("/api/zoom/account/{$account->id}", $data)
             ->assertStatus(200);

        $this->assertDatabaseHas('zoom_accounts', $data);
    }

    /** @test */
    public function testDeleteAccount()
    {
        $account = Account::factory()->create();

        $this->delete("/api/zoom/account/{$account->id}")
             ->assertStatus(200);

        $this->assertDatabaseMissing('zoom_accounts', [
            'id' => $account->id,
            'account' => $account->account,
            'client' => $account->client,
            'secret' => $account->secret,
            'owner_id' => $account->owner_id,
        ]);
    }

}

