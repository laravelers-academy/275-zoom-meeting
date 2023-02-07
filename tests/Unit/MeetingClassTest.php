<?php

namespace LaravelersAcademy\ZoomMeeting\Tests\Unit;

use LaravelersAcademy\ZoomMeeting\Tests\TestCase;
use LaravelersAcademy\ZoomMeeting\Zoom\Meeting as ZoomMeeting;
use LaravelersAcademy\ZoomMeeting\Facades\Meeting;

class MeetingClassTest extends TestCase
{

	/** @test */
	public function testHolaMethodReturnsHolaMundo()
	{
	    $meeting = new ZoomMeeting();

	    $result = $meeting->hola();

	    $this->assertEquals('Hola mundo!', $result);
	}

	/** @test */
	public function testHolaMethodReturnsHolaMundoFromFacade()
	{

	    $result = Meeting::hola();

	    $this->assertEquals('Hola mundo!', $result);
	}

	/** @test */
	public function testGetMethodWithCustomCredentials()
	{

	    $meetingId = getenv('zoom_meeting_id');

	    $response = Meeting::set([
	        'account' => getenv('zoom_account'),
			'client' => getenv('zoom_client'),
			'secret' => getenv('zoom_secret'),
	    ])->get($meetingId);

	    $this->assertEquals($response['id'], $meetingId);

	}

	/** @test */
	public function testGetMethodWithGlobalCredentials()
	{

	    $meetingId = getenv('zoom_meeting_id');

	    $response = Meeting::get($meetingId);

	    $this->assertEquals($response['id'], $meetingId);

	}

	/** @test */
	public function testCreateMeetingWithCustomCredentials()
	{

		$data = [
	        'topic' => 'Mi reunión desde la API',
	        'start_time' => '023-01-27T02:00:00Z',
	        'duration' => 60,
	        'timezone' => 'America/Mexico_City',
	        'password' => '123456789',
	    ];
	    
	    $response = Meeting::set([
	        'account' => getenv('zoom_account'),
			'client' => getenv('zoom_client'),
			'secret' => getenv('zoom_secret'),
	    ])->create($data);

	    $this->assertEquals($response['topic'], $data['topic']);

	}

	/** @test */
	public function testCreateMeetingWithGlobalCredentials()
	{

		$data = [
	        'topic' => 'Mi reunión desde la API',
	        'start_time' => '023-01-27T02:00:00Z',
	        'duration' => 60,
	        'timezone' => 'America/Mexico_City',
	        'password' => '123456789',
	    ];
	    
	    $response = Meeting::create($data);

	    $this->assertEquals($response['topic'], $data['topic']);

	}

}

