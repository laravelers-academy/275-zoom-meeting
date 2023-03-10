<?php

namespace LaravelersAcademy\ZoomMeeting\Zoom;

use LaravelersAcademy\ZoomMeeting\Zoom\Authorization;
use LaravelersAcademy\ZoomMeeting\Exceptions\ZoomMeetingValidationException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class Meeting extends Authorization
{

    public function hola()
    {

        return 'Hola mundo!';

    }


	public function get($meetingId)
    {

        $this->checkEnv();

    	$url = $this->baseUrl . 'meetings/' . $meetingId;

    	$response = Http::withToken($this->accessToken)->get($url)->json();

    	return $response;

    }

    public function create(array $data)
    {

        $this->checkEnv();

        $this->validate($data);

    	$url = $this->baseUrl . 'users/me/meetings';

    	$data = json_encode($data);

    	$response = Http::withToken($this->accessToken)
    		->withHeaders([
    			'content-type' => 'application/json'
    		])
    		->withBody($data, 'application/json')
    		->post($url)
    		->json();

    	return $response;

    }

    public function update($meetingId, $data)
    {

        $this->checkEnv();

        $this->validate($data);

    	$url = $this->baseUrl . 'meetings/' . $meetingId;

    	$data = json_encode($data);

    	Http::withToken($this->accessToken)
    		->withHeaders([
    			'content-type' => 'application/json'
    		])
    		->withBody($data, 'application/json')
    		->patch($url)
    		->json();

    	$response = $this->get($meetingId);

    	return $response;

    }

    public function delete($meetingId)
    {

        $this->checkEnv();

    	$url = $this->baseUrl . 'meetings/' . $meetingId;

    	$response = Http::withToken($this->accessToken)->delete($url)->json();

    	return $response;

    }

    private function validate(array $data)
    {   

        $validator = Validator::make($data, [
            'topic'      => 'required|string|max:255',
            'start_time' => 'required|string|date',
            'duration'   => 'required',
            'timezone'   => [
                'required',
                Rule::in(config('zoom.timezones'))
            ],
            'password'   => 'required|min:6',
        ]);

        if ($validator->fails()) {

            throw new ZoomMeetingValidationException($validator);

        }

    }

}