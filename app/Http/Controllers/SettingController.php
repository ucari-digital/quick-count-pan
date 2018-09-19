<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\DivisiJaringan;
class SettingController extends Controller
{
    public function divisiJaringan()
    {
    	$data = DivisiJaringan::all();
    	return view('page.setting.divisi_jaringan', compact('data'));
    }

    public function divisiJaringanSubmit(Request $request)
    {
    	try {
    		$field = new DivisiJaringan;
    		$field->name = $request->name;
    		$field->save();
    		return redirect()->back()
	    	->with('status', 'success')
	    	->with('message', 'Berhasil menambah divisi jaringan');
		} catch (\Exception $e) {
			return $e->getMessage();
		}	
    }

    public function divisiJaringanEdit($id)
    {
    	$edit = DivisiJaringan::where('id', $id)->first();
    	$data = DivisiJaringan::all();
    	return view('page.setting.edit_divisi_jaringan', compact('edit', 'data'));
    }

    public function divisiJaringanUpdate(Request $request, $id)
    {
    	try {
    		$data = DivisiJaringan::where('id', $id)->update([
    			'name' => $request->name,
    		]);
    		return redirect()->back()
	    	->with('status', 'success')
	    	->with('message', 'Berhasil mengubah divisi jaringan');
    	} catch (\Exception $e) {
    		return $e->getMessage();
    	}
    }

    public function divisiJaringanDelete($id)
    {
    	$data = DivisiJaringan::where('id', $id)->update([
    		'is_deleted' => 'true',
    	]);
    	return redirect()->back()
	    	->with('status', 'success')
	    	->with('message', 'Berhasil menghapus divisi jaringan');
    }
}
