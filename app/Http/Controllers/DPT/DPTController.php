<?php

namespace App\Http\Controllers\DPT;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Excel;

use App\Helper\Lib;
use App\Model\Anggota;
use App\Model\Provinsi;
use App\Model\Kota;
use App\Model\Kecamatan;
use App\Model\Kelurahan;
class DPTController extends Controller
{
    public function provinsi()
    {
    	$title = 'provinsi';
    	$url = 'kabkota';
    	$data_provinsi = provinsi::all();
    	$data = [];
    	foreach ($data_provinsi as $numb => $item) {
    		$data[$numb] = $item;
    		$data[$numb]['dpt'] = Anggota::where('provinsi', $item->id)->where('role', 'pemilih')->count();
    	}
    	return view('dpt.dpt', compact('data', 'url', 'title'));
    }

    public function kabkota($id)
    {
    	$title = 'Kabupaten / Kota';
    	$url = 'kecamatan';
    	$data_lokasi = Kota::where('province_id', $id)->get();
    	$data = [];
    	foreach ($data_lokasi as $numb => $item) {
    		$data[$numb] = $item;
    		$data[$numb]['dpt'] = Anggota::where('kabkota', $item->id)->where('role', 'pemilih')->count();
    	}
    	return view('dpt.dpt', compact('data', 'url', 'title'));
    }

    public function kecamatan($id)
    {
    	$title = 'Kecamatan';
    	$url = 'kelurahan';
    	$data_lokasi = Kecamatan::where('kota_id', $id)->get();
    	$data = [];
    	foreach ($data_lokasi as $numb => $item) {
    		$data[$numb] = $item;
    		$data[$numb]['dpt'] = Anggota::where('kecamatan', $item->id)->where('role', 'pemilih')->count();
    	}
    	return view('dpt.dpt', compact('data', 'url', 'title'));
    }

    public function kelurahan($id)
    {
    	$title = 'Kelurahan';
    	$url = 'anggota';
    	$data_lokasi = Kelurahan::where('kecamatan_id', $id)->get();
    	$data = [];
    	foreach ($data_lokasi as $numb => $item) {
    		$data[$numb] = $item;
    		$data[$numb]['dpt'] = Anggota::where('kelurahan', $item->id)->where('role', 'pemilih')->count();
    	}
    	return view('dpt.dpt', compact('data', 'url', 'title'));
    }

    public function anggota($id)
    {
    	$data = Anggota::where('kelurahan', $id)->where('role', 'pemilih')->get();
    	return view('dpt.anggota', compact('data'));
    }

    public function import()
    {
    	return view('dpt.import');
    }

    public function upload(Request $request)
    {
        try {
        	$excel = $request->excel->getRealPath();
        	$data = Excel::selectSheets('FORM')->load($excel, function($reader){
        		$reader->setDateFormat('Y-m-d');
        		foreach ($reader->get() as $item) {
                    $tgl = substr($item->tgl_lahir, 0, 2);
                    $bln = substr($item->tgl_lahir, 3, 2);
                    $thn = substr($item->tgl_lahir, 6, 4);
        			$field = new Anggota;
        			$field->group_id = Lib::auth()->group_id;
    		        $field->referred_by = Lib::auth()->anggota_id;
    		    	$field->name = $item->nama;
    		    	$field->no_ktp = ''.$item->nik;
    		    	$field->no_kartu_keluarga = ''.$item->nkk;
    		    	$field->jk = $item->jenis_kelamin;
    		    	$field->ttl = $item->tp_lahir.','.$thn.'-'.$bln.'-'.$tgl;
    		    	$field->status_kawin = $item->status_kawin;
    		    	$field->alamat = $item->alamat;
    		    	$field->rtrw = $item->rt.'/'.$item->rw;
    		    	$field->tps = $item->tps;
    		    	$field->kelurahan = $item->kode_desa;
    		    	$field->kecamatan = $item->kode_kecamatan;
    		    	$field->kabkota = $item->kode_kabupaten;
    		    	$field->provinsi = $item->kode_provinsi;
    		    	$field->posisi = 'pemilih';
    		    	$field->role = 'pemilih';
    		    	$field->save();
        		}
        	});

            return redirect()->back()
            ->with('status', 'success')
            ->with('message', 'Berhasil Import data');
        } catch (\Exception $e) {
            return redirect()->back()
            ->with('status', 'success')
            ->with('message', $e->getMessage);
        }
    }
}
