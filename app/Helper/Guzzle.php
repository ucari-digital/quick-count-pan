<?php
namespace App\Helper;

use GuzzleHttp\Client;
use \GuzzleHttp\Psr7\Request as ClientRequest;
class Guzzle
{
	public static function request($param)
	{
		$client  = new Client;
		$response = $client->request($param['method'], env('API_URL', '').$param['url'], $param['request']);
        return json_decode($response->getBody(), true);
	}

	public static function requestAsync($param)
	{
		$client  = new Client;
		$promise = $client->requestAsync($param['method'], env('API_URL', '').$param['url'], $param['request']);
		$promise->then(
		    function ($response) {
		        return $response->getBody();
		    },
		    function ($response) {
		        return '$response->getMessage()';
		    }
		);
		return json_decode($promise->wait()->getBody(), true);
	}
}