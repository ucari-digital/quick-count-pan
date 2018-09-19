<?php
namespace App\Helper;

use App\Helper\Guzzle;

/**
 * SMS Helper untuk ADSMEDIA
 */
class Sms
{
    public static function key()
    {
        return 'gibbfdyx4szugaayy1bbm7wt2jj1fmrw';
    }

	public static function send($data)
	{
		$param = [
            'full_url' => true,
            'method' => 'POST',
            'url' => env('API_SMS_URL', '').'/sms-send',
            'request' => [
                'allow_redirects' => true,
                'headers' => [
                    'Authorization' => self::key()
                ],
                'form_params' => [
                    'type' => 'reguler',
                    'number' => $data['number'],
                    'text' => $data['text']
                ]
            ]
        ];
		return Guzzle::request($param);
		// return $param;
	}

    public static function saldo()
    {
        $param = [
            'full_url' => true,
            'method' => 'GET',
            'url' => env('API_SMS_URL', '').'/saldo-cek',
            'request' => [
                'allow_redirects' => true,
                'headers' => [
                    'Authorization' => self::key()
                ],
            ]
        ];
        return Guzzle::request($param);
    }

    public static function historySms()
    {
        $param = [
            'full_url' => true,
            'method' => 'GET',
            'url' => env('API_SMS_URL', '').'/history-sms',
            'request' => [
                'allow_redirects' => true,
                'headers' => [
                    'Authorization' => self::key()
                ],
            ]
        ];
        return Guzzle::request($param);
    }
}