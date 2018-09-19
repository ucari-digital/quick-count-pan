<?php

namespace App\Helper;

class Response
{
	static function json($data, $message, $status, $code)
	{
		$payload = [
			'status' => $code,
			'response' => $status,
			'msg' => $message,
			'data' => $data
		];

		return $payload;
	}
}