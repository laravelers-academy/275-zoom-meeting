<?php

namespace App\Classes\Zoom;

use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Nowakowskir\JWT\JWT;
use Nowakowskir\JWT\TokenDecoded;
use Nowakowskir\JWT\TokenEncoded;

class Zoom 
{
	public $account;	

	public $client;
	
	protected $secret;

	protected $client_secret;
	
	protected $authResponse;

	public $status;

	protected $base_url =  'https://api.zoom.us/v2/';

	public function __construct($account, $client, $secret)
	{
		
		try {

			$this->account = decrypt($account);

			$this->client = decrypt($client);
			
			$this->secret = decrypt($secret);

			$this->authResponse = $this->authorization(); 

			$this->status = $this->getStatus();

		} catch( \Exception $e) {

			abort(500);

		} 

	}

	private function authorization()
	{

		$url = "https://zoom.us/oauth/token?grant_type=account_credentials&account_id=$this->account";

		$response = Http::withHeaders([
			'Authorization' => 'Basic ' . $this->getClientSecret(),
		])->post($url);

		return $response->json();

	}

	private function getClientSecret()
	{

		return base64_encode($this->client . ':' . $this->secret);

	}

	private function getStatus()
	{

		return !array_key_exists('error', $this->authResponse);

	}

	
    public function getMeeting($meeting_id)
    {

    	$url = $this->base_url . 'meetings/' . $meeting_id;

    	$response = Http::withToken($this->authResponse['access_token'])->get($url)->json();

    	return $response;

    }

    public function createMeeting(array $data)
    {

    	$url = $this->base_url . 'users/me/meetings';

    	$data = json_encode($data);

    	$response = Http::withToken($this->authResponse['access_token'])
    		->withHeaders([
    			'content-type' => 'application/json'
    		])
    		->withBody($data, 'application/json')
    		->post($url)
    		->json();

    	return $response;

    }

    public function updateMeeting($meeting_id, $data)
    {

    	$url = $this->base_url . 'meetings/' . $meeting_id;

    	$data = json_encode($data);

    	Http::withToken($this->authResponse['access_token'])
    		->withHeaders([
    			'content-type' => 'application/json'
    		])
    		->withBody($data, 'application/json')
    		->patch($url)
    		->json();

    	$response = $this->getMeeting($meeting_id);

    	return $response;

    }

    public function deleteMeeting($meeting_id)
    {

    	$url = $this->base_url . 'meetings/' . $meeting_id;

    	$response = Http::withToken($this->authResponse['access_token'])->delete($url)->json();

    	return $response;

    }

}