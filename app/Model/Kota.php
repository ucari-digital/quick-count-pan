<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    protected $table = 'kota';

    public static function getName($id)
    {
    	return self::where('id', $id)->first();
    }
}
