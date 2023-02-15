<?php

namespace LaravelersAcademy\ZoomMeeting\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use LaravelersAcademy\ZoomMeeting\Models\Account;
use LaravelersAcademy\ZoomMeeting\Models\Meeting;
use LaravelersAcademy\ZoomMeeting\Tests\TestCase;

class MeetingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testCreateMeeting()
    {
        $account = Account::factory()->create([
        	'account' => getenv('zoom_account'),
            'client' => getenv('zoom_client'),
            'secret' => getenv('zoom_secret'),
        ]);

        $data = [
        	'topic' => 'Mi reunión desde la API',
            'start_time' => '023-01-27T02:00:00Z',
            'duration' => 60,
            'timezone' => 'America/Mexico_City',
            'password' => '123456789',
            'account_id' => $account->id,
        ];

        $this->postJson('/api/zoom/meeting/create', $data)
             ->assertStatus(201);

        $this->assertDatabaseHas('zoom_meetings', ['account_id' => $account->id]);
    }

    /** @test */
    public function testShowMeeting()
    {
        $account = Account::factory()->create([
            'account' => getenv('zoom_account'),
            'client' => getenv('zoom_client'),
            'secret' => getenv('zoom_secret'),
        ]);

        $meeting = Meeting::factory()->create(['account_id' => $account->id]);

        $response = $this->getJson("/api/zoom/meeting/{$meeting->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'id' => $meeting->id,
                     'payload' => $meeting->payload,
                     'account_id' => $meeting->account_id,
                 ]);
    }

    /** @test */
    public function testUpdateMeeting()
    {
        $account = Account::factory()->create([
        	'account' => getenv('zoom_account'),
            'client' => getenv('zoom_client'),
            'secret' => getenv('zoom_secret'),
        ]);

        $meeting = Meeting::factory()->create(['account_id' => $account->id]);

        $data = [
            'topic' => 'Mi reunión desde la API',
            'start_time' => '023-01-27T02:00:00Z',
            'duration' => 60,
            'timezone' => 'America/Mexico_City',
            'password' => '123456789',
            'meeting_id' => $meeting->id,
        ];

        $this->putJson("/api/zoom/meeting/{$meeting->id}", $data)
             ->assertStatus(200);

        $this->assertDatabaseHas('zoom_meetings', ['account_id' => $account->id]);
    }

    /** @test */
    public function testDeleteMeeting()
    {
        $account = Account::factory()->create([
        	'account' => getenv('zoom_account'),
            'client' => getenv('zoom_client'),
            'secret' => getenv('zoom_secret'),
        ]);

        $meeting = Meeting::factory()->create(['account_id' => $account->id]);

        $this->delete("/api/zoom/meeting/{$meeting->id}")
             ->assertStatus(200);

        $this->assertDatabaseMissing('zoom_meetings', [
            'id' => $meeting->id,
            'payload' => $meeting->payload,
            'account_id' => $meeting->account_id,
        ]);
    }
    
}