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

}

