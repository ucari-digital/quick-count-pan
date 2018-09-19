<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    protected $table = 'provinsi';
    
    public static function getName($id)
    {
    	return self::where('id', $id)->first();
    }
}
