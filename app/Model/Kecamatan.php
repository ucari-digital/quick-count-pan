<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $table = 'kecamatan';

    public static function getName($id)
    {
    	return self::where('id', $id)->first();
    }
}
