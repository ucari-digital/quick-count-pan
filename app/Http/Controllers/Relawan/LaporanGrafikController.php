<?php

namespace App\Http\Controllers\Relawan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Helper\Lib;
use App\Http\Controllers\GSController;

use App\Model\Anggota;
use App\Model\Provinsi;
use App\Model\Kota;
use App\Model\Kelurahan;
use App\Model\Kecamatan;
class LaporanGrafikController extends Controller
{
    public function index($field, $id = 0)
    {
    	$auth = Lib::auth();
    	if ($field == 'kota') {
    		$data = Kota::whereIn('id', GSController::cityAvailabel())->get();
    		$chart = [];
    		foreach ($data as $numb => $item) {
    			$chart['name'][] = $item->name;
    			$chart['value'][] = Anggota::where('group_id', $auth->group_id)->where('role', 'relawan')->where('kabkota', $item->id)->count();
    			$chart['url'][] = url('relawan/laporan/grafik/kecamatan/'.$item->id);
    		}
    	}
    	if ($field == 'kecamatan') {
    		$data = Kecamatan::where('kota_id', $id)->get();
    		$chart = [];
    		foreach ($data as $numb => $item) {
    			$chart['name'][] = $item->name;
    			$chart['value'][] = Anggota::where('group_id', $auth->group_id)->where('role', 'relawan')->where('kecamatan', $item->id)->count();
    			$chart['url'][] = url('relawan/laporan/grafik/kelurahan/'.$item->id);
    		}
    	}
    	if ($field == 'kelurahan') {
    		$data = Kelurahan::where('kecamatan_id', $id)->get();
    		$chart = [];
    		foreach ($data as $numb => $item) {
    			$chart['name'][] = $item->name;
    			$chart['value'][] = Anggota::where('group_id', $auth->group_id)->where('role', 'relawan')->where('kelurahan', $item->id)->count();
    			$chart['url'][] = '#';
    		}
    	}
    	return view('relawan.laporan-grafik.laporan-relawan-grafik', compact('chart'));
    }
}
