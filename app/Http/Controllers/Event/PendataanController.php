<?php

namespace App\Http\Controllers\Event;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use DB;
use App\Helper\Lib;

use App\Model\Anggota;
use App\Model\Kota;
use App\Model\Kecamatan;
use App\Model\Kelurahan;
use App\Model\Kandidat;
use App\Model\QuicCount;
use App\Model\Saksi;

use App\Http\Controllers\GSController;
class PendataanController extends Controller
{
    public function praEvent($title, $id = '')
    {
    	$auth = Lib::auth();
    	if ($title == 'kota') {
            $data = Kota::whereIn('id', GSController::cityAvailabel())->get();
            $button_text = 'Lihat';
            $button_url = 'event/pendataan/pra-event/kecamatan/';
            $data_set = [];
            foreach($data as $numb => $item){
                $data_set[$numb] = $item;

                $data_set[$numb]['pemilih'] = Anggota::where('group_id', Lib::auth()->group_id)
                ->where('kabkota', $item->id)
                ->where('role', 'pemilih')
                ->count();

                $data_set[$numb]['suara_masuk'] = Anggota::where('group_id', Lib::auth()->group_id)
                ->where('kabkota', $item->id)
                ->where('kandidat_id', '!=', null)
                ->where('role', 'pemilih')
                ->count();

                $data_set[$numb]['bukti'] = Anggota::where('group_id', Lib::auth()->group_id)
                ->where('kabkota', $item->id)
                ->where('role', 'pemilih')
                ->where('foto_ktp', '!=', null)
                ->count();
            }
        }

        if ($title == 'kecamatan') {
	    	$data = Kecamatan::where('kota_id', $id)->get();
	    	$button_text = 'Lihat';
	    	$button_url = 'event/pendataan/pra-event/kelurahan/';
	    	$data_set = [];
	    	foreach($data as $numb => $item){
	    		$data_set[$numb] = $item;

	    		$data_set[$numb]['pemilih'] = Anggota::where('group_id', Lib::auth()->group_id)
                ->where('kecamatan', $item->id)
                ->where('role', 'pemilih')
                ->count();

	    		$data_set[$numb]['suara_masuk'] = Anggota::where('group_id', Lib::auth()->group_id)
                ->where('kecamatan', $item->id)
                ->where('kandidat_id', '!=', null)
                ->where('role', 'pemilih')
                ->count();

	    		$data_set[$numb]['bukti'] = Anggota::where('group_id', Lib::auth()->group_id)
                ->where('kecamatan', $item->id)
                ->where('role', 'pemilih')
                ->where('foto_ktp', '!=', null)
                ->count();
	    	}
    	}

    	if ($title == 'kelurahan') {
    		$data = Kelurahan::where('kecamatan_id', $id)->get();
    		$button_text = 'Data Pemilih';
    		$button_url = 'event/pendataan/anggota/pra-event/';
	    	$data_set = [];
	    	foreach($data as $numb => $item){
	    		$data_set[$numb] = $item;

                $data_set[$numb]['pemilih'] = Anggota::where('group_id', Lib::auth()->group_id)
                ->where('kelurahan', $item->id)
                ->where('role', 'pemilih')
                ->count();

                $data_set[$numb]['suara_masuk'] = Anggota::where('group_id', Lib::auth()->group_id)
                ->where('kelurahan', $item->id)
                ->where('kandidat_id', '!=', null)
                ->where('role', 'pemilih')
                ->count();

                $data_set[$numb]['bukti'] = Anggota::where('group_id', Lib::auth()->group_id)
                ->where('kelurahan', $item->id)
                ->where('role', 'pemilih')
                ->where('foto_ktp', '!=', null)
                ->count();
	    	}
    	}
    	return view('event.pendataan-pra-event', compact('data_set', 'title', 'button_text', 'button_url'));
    }

    public function praEventAnggota($id)
    {
    	$data = Anggota::where('kelurahan', $id)->where('role', 'pemilih')->get();
    	return view('event.anggota-pra-event', compact('data'));
    }

    public function praEventInput()
    {
        $auth = Lib::auth();
        $kandidat = Kandidat::where('group_id', Lib::auth()->group_id)->get();
        $get_tps = Saksi::where('anggota_id', $auth->anggota_id)->first();
    	$data = Anggota::where('kabkota', $get_tps->kabkota)
        ->where('kecamatan', $get_tps->kecamatan)
        ->where('kelurahan', $get_tps->kelurahan)
        ->where('tps', $get_tps->tps)
        ->where('role', 'pemilih')->get();
    	return view('event.input.pra-event', compact('data', 'kandidat'));
    }

    public function praEventSubmit(Request $request)
    {
    	try {
            if($request->bukti){
        		$file = Storage::disk('public')->put('images/bukti', $request->bukti);
    			$file_name = Storage::url($file);
            } else {
                $file_name = Anggota::where('no_ktp', $request->no_ktp)->first()->bukti;
            }

            if ($request->kandidat) {
                $data = Anggota::where('no_ktp', $request->no_ktp)
                ->update([
                    'kandidat_id' => $request->kandidat,
                    'bukti' => $file_name
                ]);
            } else {
                $data = Anggota::where('no_ktp', $request->no_ktp)
                ->update([
                    'bukti' => $file_name
                ]);
            }


            if ($request->r_type == 'json') {
                return $data;
            }

    		return redirect()->back()
	    	->with('status', 'success')
	    	->with('message', 'Berhasil mendata pemilih');
    	} catch (\Exception $e) {
    		return $e->getMessage();
    	}
    }

    public function event()
    {
        $auth = Lib::auth();
        $kandidat = Kandidat::where('group_id', $auth->group_id)->get();

        $anggota = DB::table('anggota')
            ->join('saksi', 'anggota.anggota_id', '=', 'saksi.anggota_id')
            ->where('anggota.anggota_id', Lib::auth()->anggota_id)
            ->select('saksi.kabkota', 'saksi.kecamatan', 'saksi.kelurahan', 'saksi.tps')
            ->first();
        $anggota_quick_count = QuicCount::where('group_id', Lib::auth()->group_id)
            ->where('kabkota', $anggota->kabkota)
            ->where('kecamatan', $anggota->kecamatan)
            ->where('kelurahan', $anggota->kelurahan)
            ->first();
        return view('event.input.event', compact('kandidat', 'anggota_quick_count'));
    }

    public function eventSubmit(Request $request)
    {
        try {
            if ($request->bukti) {
                $file = Storage::disk('public')->put('images/avatar', $request->bukti);
                $file_name = Storage::url($file);
            } else {
                $file_name = '';
            }

            $anggota = DB::table('anggota')
            ->join('saksi', 'anggota.anggota_id', '=', 'saksi.anggota_id')
            ->where('anggota.anggota_id', Lib::auth()->anggota_id)
            ->select('saksi.kabkota', 'saksi.kecamatan', 'saksi.kelurahan', 'saksi.tps')
            ->first();

            // menghilangkan data total_dpt dan suara tidak sah yg sama.
            $anggota_quick_count = QuicCount::where('group_id', Lib::auth()->group_id)
            ->where('kabkota', $anggota->kabkota)
            ->where('kecamatan', $anggota->kecamatan)
            ->where('kelurahan', $anggota->kelurahan)
            ->first();

            if ($anggota_quick_count) {
                $total_dpt = 0;
                $suara_tidak_sah = 0;
            } else {
                $total_dpt = $request->total_dpt;
                $suara_tidak_sah = $request->jumlah_suara_tidak_sah;
            }

            $field = new QuicCount;
            $field->group_id = Lib::auth()->group_id;
            $field->anggota_id = Lib::auth()->anggota_id;
            $field->kandidat_id = $request->kandidat_id;

            $field->total_dpt = $total_dpt;
            $field->jumlah_suara = $request->jumlah_suara;
            $field->jumlah_suara_tidak_sah = $suara_tidak_sah;
            $field->bukti = $file_name;

            $field->kabkota = $anggota->kabkota;
            $field->kecamatan = $anggota->kecamatan;
            $field->kelurahan = $anggota->kelurahan;
            $field->tps = $anggota->tps;
            $field->penyelenggaraan = 'event';
            $field->save();

            return redirect()->back()
            ->with('status', 'success')
            ->with('message', 'Data Berhasil Dikirim');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
