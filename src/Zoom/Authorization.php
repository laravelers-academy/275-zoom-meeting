<?php

namespace LaravelersAcademy\ZoomMeeting\Zoom;

use Illuminate\Support\Facades\Http;
use LaravelersAcademy\ZoomMeeting\Exceptions\ZoomAuthorizationException;

class Authorization
{

	protected $baseUrl =  'https://api.zoom.us/v2/';

	public string $account;	

	public string $client;
	
	private string $secret;

	private string $clientSecret;

	private array $authResponse;

	protected ?string $accessToken;

	protected bool $envSet = false;


	public function set(array $params)
	{

		$this->account = $params['account'];

		$this->client = $params['client'];

		$this->secret = $params['secret'];

		$this->clientSecret = $this->getClientSecret();

		$this->authResponse = $this->getAuthResponse();

		dump($this->authResponse, $params);

		$this->accessToken =  $this->getAccessToken();

		$this->envSet = $this->accessToken != null;

		return $this;

	}

	private function getClientSecret()
	{

		return base64_encode($this->client . ':' . $this->secret);

	}

	private function getAuthResponse()
	{

		$url = "https://zoom.us/oauth/token?grant_type=account_credentials&account_id=$this->account";

		$response = Http::withHeaders([
			'Authorization' => 'Basic ' . $this->clientSecret,
		])->post($url);

		return $response->json();

	}

	private function getAccessToken()
	{

		/**
		 * Verificamos que la respuesta de autenticación no retorne un error 
		 */
		if(!array_key_exists('error', $this->authResponse)) return $this->authResponse['access_token'];

		throw new ZoomAuthorizationException;

	}

	protected function checkEnv()
	{

		if(!$this->envSet) $this->setDefaultEnv();

		$message = "The Zoom account environment is not defined or it's wrong, please call the set method with the array [\"account\"=>\"\", \"client\" => \"\", \"secret\" => \"\"]";

		if(!$this->envSet) throw new ZoomAuthorizationException($message);

	}

	private function setDefaultEnv()
	{

		if(config('zoom.use_default_env')) {

			$env = [

				'account' => config('zoom.account'),

				'client' => config('zoom.client'),

				'secret' => config('zoom.secret'),

			];

			$this->set($env);

		}

	}

}