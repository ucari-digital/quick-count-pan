<?php

namespace App\Http\Controllers\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use App\Model\Slider;
use App\Model\Activity;
use App\Helper\Lib;
class SliderController extends Controller
{
    public function index()
    {
    	$data = Slider::where('group_id', Lib::auth()->group_id)->get();
    	return view('setting.slider', compact('data'));
    }

    public function create(Request $request)
    {
    	try {
    		$file = Storage::disk('public')->put('images/slider', $request->slider);
			$file_name = Storage::url($file);

    		$field = new Slider;
            $field->group_id = Lib::auth()->group_id;
    		$field->image = $file_name;
    		$field->save();

    		$field = [
                'message' => 'menambahkan slider',
                'image' => $file_name,
                'referrer' => '',
                'type' => 'simpan'
            ];
            Activity::store($field);

            return redirect()->back()
	    	->with('status', 'success')
	    	->with('message', 'Berhasil menambah slider');
    	} catch (\Exception $e) {
    		
    	}
    }

    public function delete($id)
    {
    	$del =  Slider::find($id);
    	$field = [
            'message' => 'menghapus slider',
            'image' => $del->image,
            'referrer' => '',
            'type' => 'hapus'
        ];
        Activity::store($field);
    	$del->delete();
        return redirect()->back()
    	->with('status', 'success')
    	->with('message', 'Berhasil menghapus slider');
    }
}
