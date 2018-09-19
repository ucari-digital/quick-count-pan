<?php

namespace App\Http\Controllers\Kandidat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Kandidat;
use App\Helper\Lib;
class KandidatController extends Controller
{
    public function index()
    {
    	$auth = Lib::auth();
    	$data = Kandidat::where('group_id', $auth->group_id)->get();
    	return view('kandidat.kandidat', compact('data'));
    }

    public function create()
    {
    	return view('kandidat.add-kandidat');
    }

    public function submit(Request $request)
    {
    	try {
	    	$data = new Kandidat;
	    	$data->group_id = Lib::auth()->group_id;
	    	$data->name = $request->name;
	    	$data->partai_pengusung = $request->partai_pengusung;
	    	$data->save();
	    	return redirect()->back()
	    	->with('status', 'success')
	    	->with('message', 'Berhasil menambah pasangan calon');
    	} catch (\Exception $e) {
			return $e->getMessage();
    	}
    }

    public function edit($id)
    {
    	$data = Kandidat::where('id', $id)->first();
    	return view('kandidat.edit-kandidat', compact('data'));
    }

    public function update(Request $request, $id)
    {
    	try {
    		$data = Kandidat::where('id', $id)->update([
    			'name' => $request->name,
    			'partai_pengusung' => $request->partai_pengusung
    		]);
    		return redirect()->back()
	    	->with('status', 'success')
	    	->with('message', 'Berhasil mengubah data pasangan calon');
    	} catch (\Exception $e) {
    		return $e->getMessage();
    	}
    }

    public function hapus($id)
    {
    	$data = Kandidat::where('id', $id)->delete();
    	return redirect('kandidat')
	    	->with('status', 'success')
	    	->with('message', 'Berhasil menghapus pasangan calon');
    }
}
