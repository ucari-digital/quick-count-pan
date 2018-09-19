<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    protected $table = 'kelurahan';

    public static function getName($id)
    {
    	return self::where('id', $id)->first();
    }
}
