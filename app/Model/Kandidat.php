<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Kandidat extends Model
{
	protected $table = 'kandidat';

	public static function find($id)
	{
		return self::where('id', $id)->first();
	}
}
