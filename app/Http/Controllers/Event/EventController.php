<?php

namespace App\Http\Controllers\Event;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Model\Anggota;
use App\Model\Kandidat;
use App\Model\QuicCount;
use App\Model\Kota;
use App\Model\Kecamatan;
use App\Model\Kelurahan;

use App\Helper\Lib;
use App\Http\Controllers\GSController;
class EventController extends Controller
{
    public function index($data_lokasi = null, $lokasi_id = null)
    {
    	if ($data_lokasi == null) {
	    	$setting = [
	    		'city' => 'Kota',
	    		'url' => 'kecamatan',
	    		'table' => 'kabkota',
	    		'btn_display' => 'true'
	    	];
    		$lokasi = Kota::whereIn('id', GSController::cityAvailabel())->get();
    	} elseif ($data_lokasi == 'kecamatan') {
    		$setting = [
	    		'city' => 'Kecamatan',
	    		'url' => 'kelurahan',
	    		'table' => 'kecamatan',
	    		'btn_display' => 'true'
	    	];
	    	$lokasi = Kecamatan::where('kota_id', $lokasi_id)->get();
    	} elseif ($data_lokasi == 'kelurahan') {
    		$setting = [
	    		'city' => 'Kelurahan',
	    		'url' => '',
	    		'table' => 'kelurahan',
	    		'btn_display' => 'false'
	    	];
	    	$lokasi = Kelurahan::where('kecamatan_id', $lokasi_id)->get();
    	}

    	$title = $setting['city'];
    	$button_url = 'event/hasil-pendataan/'.$setting['url'].'/';
    	$button_text = 'Lihat';
    	$button_dispay = $setting['btn_display'];

    	$data = [];
	    $kandidat = [];
	    $kandidat_chart = [];
    	$jumlah_pemilih_counter = 0;
    	$jumlah_suara = 0;
    	$jumlah_suara_tidak_sah = 0;
    	foreach ($lokasi as $numb => $item) {
    		$data_collection = QuicCount::where('group_id', Lib::auth()->group_id)
    		->where($setting['table'], $item->id)
    		->get();
    		
    		foreach ($data_collection as $numbs => $sub_item) {
    			$jumlah_pemilih_counter += $sub_item->total_dpt;
    			$jumlah_suara_tidak_sah += $sub_item->jumlah_suara_tidak_sah;
    			$jumlah_suara += $sub_item->jumlah_suara;
    		}

    		/**
    		 * Membuat array Chart
    		 */
    		
	    	$kandidat_collection = Kandidat::where('group_id', Lib::auth()->group_id)->get();
			foreach ($kandidat_collection as $numbs => $items) {
				$qc = QuicCount::where('group_id', Lib::auth()->group_id)->where($setting['table'], $item->id)->where('kandidat_id', $items->id)->get();
				$qc_count = 0;
				foreach ($qc as $xnumb => $xitem) {
					$qc_count += $xitem->jumlah_suara;
				}

				$kandidat['name'][$numbs] = $items->name;
				$kandidat['suara'][$numbs] = $qc_count;
				$kandidat['color'][$numbs] = '#'.dechex(rand(0x000000, 0xFFFFFF));

				$kandidat['by_name'][$numbs] = [
					'name' => $items->name,
					'suara' => $qc_count
				];


				$qc_count = 0;
			}

			// Sort Array Chart
			$kandidat_sorted = array_values(array_sort($kandidat['by_name'], function ($value) {
				return $value['suara'];
			}));

			$kandidat_array = array_slice($kandidat_sorted, -5);

			foreach ($kandidat_array as $no => $kitem) {
				$kandidat_chart['name'][$no] = $kitem['name'];
				$kandidat_chart['suara'][$no] = $kitem['suara'];
				$kandidat_chart['color'][$no] = '#'.dechex(rand(0x000000, 0xFFFFFF));
			}


			$data[$numb]['id'] = $item->id;
			$data[$numb]['name'] = $item->name;
    		$data[$numb]['jumlah_pemilih'] = $jumlah_pemilih_counter;
    		$data[$numb]['jumlah_suara'] = $jumlah_suara;
    		$data[$numb]['jumlah_suara_tidak_sah'] = $jumlah_suara_tidak_sah;
    		$data[$numb]['chart'] = $kandidat_chart;

    		// Set Default Value Variable
    		$jumlah_pemilih_counter = 0;
    		$jumlah_suara = 0;
    	}

    	// Limit Peserta yang tampil
    	return view('event.event', compact('data', 'title', 'button_url', 'button_text', 'button_dispay'));
    }

    public function detail()
    {
    	$data_collection = QuicCount::where('group_id', Lib::auth()->group_id)->get();

    	$data = [];
    	foreach ($data_collection as $numb => $item) {
    		$qc = QuicCount::where('kabkota', $item->kabkota)
    		->where('kecamatan', $item->kecamatan)
    		->where('kelurahan', $item->kelurahan)
    		->where('total_dpt', '<>', '0')
    		->first();

    		$data[$numb]['kota'] = Kota::getName($item->kabkota)->name;
    		$data[$numb]['kecamatan'] = Kecamatan::getName($item->kecamatan)->name;
    		$data[$numb]['kelurahan'] = Kelurahan::getName($item->kelurahan)->name;
    		$data[$numb]['tps'] = $item->tps;
    		$data[$numb]['pilihan'] = Kandidat::find($item->kandidat_id)->name;
    		$data[$numb]['jumlah_suara'] = $item->jumlah_suara;
    		$data[$numb]['jumlah_dpt'] = $qc->total_dpt;
    		$data[$numb]['bukti'] = $item->bukti;
    	}

    	return view('event.event-detail')
    	->with('data', $data);
    }

    public function chartDetail()
    {
    	$anggota_data = Kandidat::where('group_id', Lib::auth()->group_id)->get();

        $anggota = [];
        $counter = 0;
        foreach ($anggota_data as $numb => $item) {
            $qc = QuicCount::where('kandidat_id', $item->id)->get();
            foreach ($qc as $itemqc) {
                $counter += $itemqc->jumlah_suara;
            }

            $anggota[$numb]['kandidat'] = $item->name;
            $anggota[$numb]['suara'] = $counter;
            $anggota[$numb]['color'] = '#'.dechex(rand(0x000000, 0xFFFFFF));
            $counter = 0;
        }
        $arr_anggota = [];

        $collection = collect($anggota);
        $anggota = $collection->sortByDesc('suara');

        foreach ($anggota as $numb => $arr_item) {
            $arr_anggota['name'][$numb] = $arr_item['kandidat']; 
            $arr_anggota['suara'][$numb] = $arr_item['suara'];
            $arr_anggota['color'][$numb] = $arr_item['color'];
        }

        // return $arr_anggota;

    	return view('event.event-detail-chart')->with('data', $arr_anggota);
    }
}
