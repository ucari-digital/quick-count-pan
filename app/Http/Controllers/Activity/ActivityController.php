<?php

namespace App\Http\Controllers\Activity;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Activity;
use App\Helper\Lib;
class ActivityController extends Controller
{
	public function index()
	{
		$data = Activity::where('group_id', Lib::auth()->group_id)->orderBy('updated_at', 'desc')->get();
		return view('activity.activity', compact('data'));
	}
    public function store()
    {
    	
    }
}
