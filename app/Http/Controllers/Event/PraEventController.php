<?php

namespace App\Http\Controllers\Event;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Controllers\GSController;
use App\Helper\Lib;

use App\Model\Kandidat;
use App\Model\Anggota;
use App\Model\Kota;
use App\Model\Kecamatan;
use App\Model\Kelurahan;
class PraEventController extends Controller
{
    public function index()
    {
    	$title = 'Kota';
    	$button_url = 'event/hasil-pendataan/pra/kecamatan/';
    	$button_text = 'Lihat';

		// Kota
    	$lokasi = Kota::whereIn('id', GSController::cityAvailabel())->get();
    	$data = [];
    	foreach ($lokasi as $numb => $item) {
    		$jumlah_pemilih = Anggota::where('group_id', Lib::auth()->group_id)
    		->where('kabkota', $item->id)
    		->where('role', 'pemilih')
    		->count();

    		$suara_masuk = DB::table('anggota')
    		->join('kandidat', 'anggota.kandidat_id', '=', 'kandidat.id')
    		->select('kandidat.id','kandidat.name')
    		->where('anggota.group_id', Lib::auth()->group_id)
    		->where('anggota.kabkota', $item->id)
    		->where('anggota.role', 'pemilih');


    		$tidak_sah = Anggota::where('group_id', Lib::auth()->group_id)
    		->where('kabkota', $item->id)
    		->where('role', 'pemilih')
    		->where('kandidat_id', 'ts')
    		->count();

    		$tidak_jelas = Anggota::where('group_id', Lib::auth()->group_id)
    		->where('kabkota', $item->id)
    		->where('role', 'pemilih')
    		->where('kandidat_id', 'tj')
    		->count();

            $bukti = Anggota::where('group_id', Lib::auth()->group_id)
            ->where('kabkota', $item->id)
            ->where('role', 'pemilih')
            ->where('foto_ktp', '!=', null)
            ->count();

            $kandidat_data = Kandidat::where('group_id', Lib::auth()->group_id)->get();

    		$data[$numb]['id'] = $item->id;
    		$data[$numb]['name'] = $item->name;
    		$data[$numb]['suara_masuk'] = $suara_masuk->count();
    		$data[$numb]['jumlah_pemilih'] = $jumlah_pemilih;
    		$data[$numb]['tidak_sah'] = $tidak_sah;
    		$data[$numb]['tidak_jelas'] = $tidak_jelas;
            $data[$numb]['bukti'] = $bukti;

	    	$kandidat = [];
	    	foreach ($kandidat_data as $numbc => $items) {
	    		$kandidat[$numbc]['name'] = $items->name;
	    		$kandidat[$numbc]['suara'] = Anggota::where('kabkota', $item->id)->where('kandidat_id', $items->id)->count();
	    	}

	    	$Kandidat_sorted = array_values(array_sort($kandidat, function ($value) {
	    		return $value['suara'];
			}));
			$kandidat = array_slice($Kandidat_sorted, -3);

			// Kandidat Chart
			$kandidat_chart = [];
			if($kandidat){
				foreach($kandidat as $numbc => $item){
					$kandidat_chart['name'][$numbc] = $item['name'];
					$kandidat_chart['suara'][$numbc] = $item['suara'];
					$kandidat_chart['color'][$numbc] = '#'.dechex(rand(0x000000, 0xFFFFFF));
				}
			} else {
				$kandidat_chart['name'][] = '';
				$kandidat_chart['suara'][] = '';
				$kandidat_chart['color'][] = '';
			}
    		$data[$numb]['chart'] = $kandidat_chart;
    	}
    	return view('event.pra-event', compact('data', 'title', 'button_url', 'button_text'));
    }

    public function kecamatan($id)
    {
    	$title = 'Kecamatan';
    	$button_url = 'event/hasil-pendataan/pra/kelurahan/';
    	$button_text = 'Lihat';

		// Kota
    	$lokasi = Kecamatan::where('kota_id', $id)->get();
    	$data = [];
    	foreach ($lokasi as $numb => $item) {
    		$jumlah_pemilih = Anggota::where('group_id', Lib::auth()->group_id)
    		->where('kecamatan', $item->id)
    		->where('role', 'pemilih')
    		->count();

    		$suara_masuk = DB::table('anggota')
    		->join('kandidat', 'anggota.kandidat_id', '=', 'kandidat.id')
    		->select('kandidat.id','kandidat.name')
    		->where('anggota.group_id', Lib::auth()->group_id)
    		->where('anggota.kecamatan', $item->id)
    		->where('anggota.role', 'pemilih');


    		$tidak_sah = Anggota::where('group_id', Lib::auth()->group_id)
    		->where('kecamatan', $item->id)
    		->where('role', 'pemilih')
    		->where('kandidat_id', 'ts')
    		->count();

    		$tidak_jelas = Anggota::where('group_id', Lib::auth()->group_id)
    		->where('kecamatan', $item->id)
    		->where('role', 'pemilih')
    		->where('kandidat_id', 'tj')
    		->count();

            $bukti = Anggota::where('group_id', Lib::auth()->group_id)
            ->where('kecamatan', $item->id)
            ->where('role', 'pemilih')
            ->where('foto_ktp', '!=', null)
            ->count();

    		$data[$numb]['id'] = $item->id;
    		$data[$numb]['name'] = $item->name;
    		$data[$numb]['suara_masuk'] = $suara_masuk->count();
    		$data[$numb]['jumlah_pemilih'] = $jumlah_pemilih;
    		$data[$numb]['tidak_sah'] = $tidak_sah;
    		$data[$numb]['tidak_jelas'] = $tidak_jelas;
            $data[$numb]['bukti'] = $bukti;

    		$kandidat_data = Kandidat::where('group_id', Lib::auth()->group_id)->get();
	    	$kandidat = [];
	    	foreach ($kandidat_data as $numbc => $item_kandidat) {
	    		$kandidat[$numbc]['name'] = $item_kandidat->name;
	    		$kandidat[$numbc]['suara'] = Anggota::where('group_id', Lib::auth()->group_id)
	    		->where('kecamatan', $item->id)
	    		->where('kandidat_id', $item_kandidat->id)->count();
	    	}

	    	$Kandidat_sorted = array_values(array_sort($kandidat, function ($value) {
	    		return $value['suara'];
			}));
			$kandidat = array_slice($Kandidat_sorted, -3);

			// Kandidat Chart
			$kandidat_chart = [];
			if($kandidat){
				foreach($kandidat as $numbc => $item){
					$kandidat_chart['name'][$numbc] = $item['name'];
					$kandidat_chart['suara'][$numbc] = $item['suara'];
					$kandidat_chart['color'][$numbc] = '#'.dechex(rand(0x000000, 0xFFFFFF));
				}
			} else {
				$kandidat_chart['name'][] = '';
				$kandidat_chart['suara'][] = '';
				$kandidat_chart['color'][] = '';
			}
    		$data[$numb]['chart'] = $kandidat_chart;
    	}
    	// return $data;
    	return view('event.pra-event', compact('data', 'title', 'button_url', 'button_text'));
    }

    public function kelurahan($id)
    {
    	$title = 'Kelurahan';
    	$button_url = '';
    	$button_text = 'L';

		// Kota
    	$lokasi = Kelurahan::where('kecamatan_id', $id)->get();
    	$data = [];
    	foreach ($lokasi as $numb => $item) {
    		$jumlah_pemilih = Anggota::where('group_id', Lib::auth()->group_id)
    		->where('kelurahan', $item->id)
    		->where('role', 'pemilih')
    		->count();

    		$suara_masuk = DB::table('anggota')
    		->join('kandidat', 'anggota.kandidat_id', '=', 'kandidat.id')
    		->select('kandidat.id','kandidat.name')
    		->where('anggota.group_id', Lib::auth()->group_id)
    		->where('anggota.kelurahan', $item->id)
    		->where('anggota.role', 'pemilih');


    		$tidak_sah = Anggota::where('group_id', Lib::auth()->group_id)
    		->where('kelurahan', $item->id)
    		->where('role', 'pemilih')
    		->where('kandidat_id', 'ts')
    		->count();

    		$tidak_jelas = Anggota::where('group_id', Lib::auth()->group_id)
    		->where('kelurahan', $item->id)
    		->where('role', 'pemilih')
    		->where('kandidat_id', 'tj')
    		->count();

            $bukti = Anggota::where('group_id', Lib::auth()->group_id)
            ->where('kelurahan', $item->id)
            ->where('role', 'pemilih')
            ->where('foto_ktp', '!=', null)
            ->count();

    		$data[$numb]['id'] = $item->id;
    		$data[$numb]['name'] = $item->name;
    		$data[$numb]['suara_masuk'] = $suara_masuk->count();
    		$data[$numb]['jumlah_pemilih'] = $jumlah_pemilih;
    		$data[$numb]['tidak_sah'] = $tidak_sah;
    		$data[$numb]['tidak_jelas'] = $tidak_jelas;
            $data[$numb]['bukti'] = $bukti;

    		$kandidat_data = Kandidat::where('group_id', Lib::auth()->group_id)->get();
	    	$kandidat = [];
	    	foreach ($kandidat_data as $numbc => $item_kandidat) {
	    		$kandidat[$numbc]['name'] = $item_kandidat->name;
	    		$kandidat[$numbc]['suara'] = Anggota::where('group_id', Lib::auth()->group_id)
	    		->where('kelurahan', $item->id)
	    		->where('kandidat_id', $item_kandidat->id)->count();
	    	}

	    	$Kandidat_sorted = array_values(array_sort($kandidat, function ($value) {
	    		return $value['suara'];
			}));
			$kandidat = array_slice($Kandidat_sorted, -3);

			// Kandidat Chart
			$kandidat_chart = [];
			if($kandidat){
				foreach($kandidat as $numbc => $item){
					$kandidat_chart['name'][$numbc] = $item['name'];
					$kandidat_chart['suara'][$numbc] = $item['suara'];
					$kandidat_chart['color'][$numbc] = '#'.dechex(rand(0x000000, 0xFFFFFF));
				}
			} else {
				$kandidat_chart['name'][] = '';
				$kandidat_chart['suara'][] = '';
				$kandidat_chart['color'][] = '';
			}
    		$data[$numb]['chart'] = $kandidat_chart;
    	}
    	// return $kota;
    	return view('event.pra-event', compact('data', 'title', 'button_url', 'button_text'));
    }
}
