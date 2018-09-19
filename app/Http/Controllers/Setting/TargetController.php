<?php

namespace App\Http\Controllers\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Target;
use App\Model\Activity;
class TargetController extends Controller
{
    public function index()
    {
    	$data = Target::find(1);
    	return view('setting.target', compact('data'));
    }

    public function store(Request $request)
    {
    	try {
    		$data = Target::find(1);
    		if ($request->relawan) {
	    		$field = [
	                'message' => 'mengubah target relawan dari '.$data->relawan.' menjadi '.$request->relawan,
	                'image' => '',
	                'referrer' => '',
	                'type' => 'update'
	            ];
	            Activity::store($field);
    		}

    		if ($request->pemilih) {
	    		$field = [
	                'message' => 'mengubah target pemilih dari '.$data->pemilih.' menjadi '.$request->pemilih,
	                'image' => '',
	                'referrer' => '',
	                'type' => 'update'
	            ];
	            Activity::store($field);
    		}

    		$data->relawan = $request->relawan;
    		$data->pemilih = $request->pemilih;
    		$data->save();

    		return redirect()->back()
	    	->with('status', 'success')
	    	->with('message', 'Berhasil Mengubah Target');
    	} catch (\Exception $e) {
    		return redirect()->back()
	    	->with('status', 'failed')
	    	->with('message', 'Terjadi Kesalahan : '.$e->getMessage());
    	}
    }
}
