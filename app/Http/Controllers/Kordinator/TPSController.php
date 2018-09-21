<?php

namespace App\Http\Controllers\Kordinator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Hash;
use App\Model\Anggota;
use App\Model\Provinsi;
use App\Model\Kota;
use App\Model\Kecamatan;
use App\Model\Kelurahan;
use App\Model\Activity;

use App\Helper\TimeFormat;
use App\Helper\Lib;
use App\Helper\FileUpload;
use App\Helper\Setting;
use App\Http\Controllers\GController;
class TPSController extends Controller
{
    public function index()
    {
        try {
        	$data_tps = Anggota::where('posisi', 'tps')->get();
            $provinsi = Setting::Provinsi();
            $data = [];
            foreach ($data_tps as $numb => $item) {
                $data[$numb] = $item;
                $data[$numb]['downline'] = Anggota::where('referred_by', $item->anggota_id)->where('role', 'kordinator')->count();
            }
        	return view('kordinator.tps.tps', compact('data', 'provinsi'));
        } catch (\Exception $e) {
           
        }
    }

    public function create()
    {
    	$provinsi = Setting::Provinsi();
    	return view('kordinator.tps.add-tps', compact('provinsi'));
    }

    public function submit(Request $request)
    {
    	try {
            $time = new TimeFormat;

            $file_upload = FileUpload::foto($request, 'foto');
            $file_upload = FileUpload::foto($request, 'foto_ktp');

            if ($file_upload == 'failed') {
                return redirect()->back()
                ->with('status', 'failed')
                ->with('message', 'Tipe data yang diupload tidak didukung');
            }

            $ttl = $time->date($request->tgl_lahir)->toFormat('sys');
            $file = Storage::disk('public')->put('images/avatar', $request->foto);
            $file_name = Storage::url($file);

            $file_ktp = Storage::disk('public')->put('images/ktp', $request->foto_ktp);
            $file_name_ktp = Storage::url($file_ktp);

            $input = $request;
            $input['ttl'] = $request->tempat.','.$ttl;
            $input['posisi'] = 'tps';
            $input['role'] = 'kordinator';
            $input['avatar'] = $file_name;
            $input['group_id'] = Lib::auth()->group_id;
            $input['referred_by'] = Lib::auth()->anggota_id;
            $input['fktp'] = $file_name_ktp;

	    	$anggota = Anggota::store($input);
            $field = [
                'message' => 'mendaftarkan <b>'.$anggota->name.'</b> sebagai Koordinator TPS',
                'image' => '',
                'referrer' => $anggota->id,
                'type' => 'simpan'
            ];
            Activity::store($field);

	    	return redirect('kordinator/tps/create')
	    	->with('status', 'success')
	    	->with('message', 'Berhasil mendaftarkan anggota');
    	} catch (\Exception $e) {
    		return $e->getMessage();
    	}
    }

    public function edit($anggota_id)
    {
        try {
        	$provinsi = Setting::Provinsi();
        	$data = Anggota::where('anggota_id', $anggota_id)->first();
        	return view('kordinator.tps.edit-tps', compact('provinsi', 'data'));
        } catch (\Exception $e) {
            
        }
    }

    public function update(Request $request, $anggota_id)
    {
    	try {
    		$anggota_data = Anggota::where('anggota_id', $anggota_id)->first();
            $time = new TimeFormat;
            $ttl = $time->date($request->tgl_lahir)->toFormat('sys');

            $file_upload = FileUpload::foto($request, 'foto');
            $file_upload = FileUpload::foto($request, 'foto_ktp');

            if ($file_upload == 'failed') {
                return redirect()->back()
                ->with('status', 'failed')
                ->with('message', 'Tipe data yang diupload tidak didukung');
            }

            $input = $request;
            $input['ttl'] = $request->tempat.','.$ttl;
            $input['posisi'] = 'tps';
            $input['role'] = 'kordinator';

            if (empty($request->foto)) {
                $input['avatar'] = $anggota_data->foto;
            } else {
                $file = Storage::disk('public')->put('images/avatar', $request->foto);
                $file_name = Storage::url($file);
                $input['avatar'] = $file_name;
            }

            if (empty($request->foto_ktp)) {
                $input['fktp'] = $anggota_data->foto_ktp;
            } else {
                $file_ktp = Storage::disk('public')->put('images/ktp', $request->foto_ktp);
                $file_name_ktp = Storage::url($file_ktp);
                $input['fktp'] = $file_name_ktp;
            }

            if (empty($request->password)) {
                $input['password'] = $anggota_data->password;
            } else {
                $input['password'] = Hash::make($request->password);    
            }

	    	$anggota = Anggota::commit($anggota_id, $input);

	    	return redirect('kordinator/tps/edit/'.$request->anggota_id)
	    	->with('status', 'success')
	    	->with('message', 'Berhasil mengubah data');
    	} catch (\Exception $e) {
    		return $e->getMessage();	
    	}
    }

    public function advSearch(Request $request)
    {
        $request['posisi'] = 'tps';
        $data_kabkota = GSController::advancedSearch($request, 'kordinator');
        $provinsi = Setting::Provinsi();
        $data = [];
        foreach ($data_kabkota as $numb => $item) {
            $data[$numb] = $item;
            $data[$numb]['downline'] = Anggota::where('referred_by', $item->anggota_id)->where('role', 'kordinator')->count();
        }

        return view('kordinator.tps.add-tps', compact('data', 'provinsi'));
    }
}
