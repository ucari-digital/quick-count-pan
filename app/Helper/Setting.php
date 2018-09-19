<?php

namespace App\Helper;
use App\Model\Provinsi;
class Setting
{
	static function Provinsi()
	{
		$provinsi = Provinsi::where('id', '32')->get();
		return $provinsi;
	}
}