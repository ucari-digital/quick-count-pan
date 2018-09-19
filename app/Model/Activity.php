<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Helper\Lib;
class Activity extends Model
{
    protected $table = 'activity';

    public static function store($r)
    {
    	try {
    		$field = new self;
    		$field->group_id = Lib::auth()->group_id;
    		$field->anggota_id = Lib::auth()->anggota_id;
    		$field->message = $r['message'];
    		$field->image = $r['image'];
    		$field->referrer = $r['referrer'];
    		$field->type = $r['type'];
    		$field->save();
    	} catch (Exception $e) {
    		
    	}
    }
}
