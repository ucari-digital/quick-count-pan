<?php

namespace App\Http\Controllers\Saksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Helper\Lib;

use App\Model\Saksi;
use App\Model\Anggota;
class SaksiController extends Controller
{
    public function create(Request $request)
    {
    	try {
    		$field = new Saksi;
    		$field->group_id = Lib::auth()->group_id;
    		$field->anggota_id = $request->anggota_id;
    		$field->kabkota = $request->kabkota;
    		$field->kecamatan = $request->kecamatan;
    		$field->kelurahan = $request->kelurahan;
    		$field->tps = $request->tps;
    		$field->save();

    		Anggota::where('anggota_id', $request->anggota_id)->update([
    			'saksi_id' => $field->id,
    			'posisi' => 'saksi'
    		]);

    		return redirect()->back()
	    	->with('status', 'success')
	    	->with('message', 'Berhasil menjadikan saksi');
    	} catch (\Exception $e) {
    		return $e->getMessage();
    	}
    }

    public function delete($anggota_id)
    {
    	Anggota::where('anggota_id', $anggota_id)->update([
    		'saksi_id' => null,
            'posisi' => 'relawan'
    	]);

    	Saksi::where('anggota_id', $anggota_id)->delete();
    	return redirect()->back()
    	->with('status', 'success')
    	->with('message', 'Anggota tidak menjadi saksi');
    }
}
