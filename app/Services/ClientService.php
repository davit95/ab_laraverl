<?php

namespace App\Services;

use GuzzleHttp\Client;

class ClientService
{
	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	public function getAreaCodes($country_code)
	{
		$params = [
			"action"		=>	"getPhoneNumberInventory",
			"username" 		=>	"abcn",
			"password"		=>	'Jn5Gzc4%',
			"clTRID"		=>	"12345678",
			"countryCode"   =>	$country_code,
		];
		$response = json_decode( json_encode($this->client->post('https://control.phone.com/special/xmlapi',[ 'body' => $params ])->xml()), true);
		return $response['resultData']['phoneNumberList']['phoneNumber'];
	}

	public function getAreaNumbersByAreaPrefix($country_code, $prefix)
	{
		$params = [
			"action"		=>	"getPhoneNumberInventory",
			"username" 		=>	"abcn",
			"password"		=>	'Jn5Gzc4%',
			"clTRID"		=>	"12345678",
			"countryCode"   =>	$country_code,
			"pattern"       =>  $prefix."*******"
		];
		$response = json_decode( json_encode($this->client->post('https://control.phone.com/special/xmlapi',[ 'body' => $params ])->xml()), true);
		return $response['resultData']['phoneNumberList']['phoneNumber'];
	}
}