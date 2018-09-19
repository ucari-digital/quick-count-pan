<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use App\Helper\Lib;
class Target extends Model
{
    protected $table = 'target';

    public static function store($id)
    {
    	$finder = self::where('group_id', Lib::auth()->group_id)->first();

    	if (empty($finder)) {
    		$field = new self;
    		$field->group_id = $id;
    		$field->save();
    	}
    }
}
