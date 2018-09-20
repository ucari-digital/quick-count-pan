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
class KelurahanController extends Controller
{
    public function index()
    {
    	$data_kelurahan = Anggota::where('posisi', 'kelurahan')->get();
        $provinsi = Setting::Provinsi();
        $data = [];
        foreach ($data_kelurahan as $numb => $item) {
            $data[$numb] = $item;
            $data[$numb]['downline'] = Anggota::where('referred_by', $item->anggota_id)->where('role', 'kordinator')->count();
        }
    	return view('kordinator.kelurahan.kelurahan', compact('data', 'provinsi'));
    }

    public function create()
    {
    	$provinsi = Setting::Provinsi();
        $kordinator_kota = Anggota::where('posisi', 'kabkota')->get();
    	return view('kordinator.kelurahan.add-kelurahan', compact('provinsi', 'kordinator_kota'));
    }

    public function submit(Request $request)
    {
    	try {
	    	{
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
            $input['posisi'] = 'kelurahan';
            $input['role'] = 'kordinator';
            $input['avatar'] = $file_name;
            $input['group_id'] = Lib::auth()->group_id;
            $input['referred_by'] = Lib::auth()->anggota_id;
            $input['fktp'] = $file_name_ktp;

	    	$anggota = Anggota::store($input);
            $field = [
                'message' => 'mendaftarkan <b>'.$anggota->name.'</b> sebagai Koordinator Kelurahan',
                'image' => '',
                'referrer' => $anggota->id,
                'type' => 'simpan'
            ];
            Activity::store($field);

	    	return redirect('kordinator/kelurahan/create')
	    	->with('status', 'success')
	    	->with('message', 'Berhasil mendaftarkan anggota');
    	} catch (\Exception $e) {
    		return $e->getMessage();
    	}
    }

    public function edit($anggota_id)
    {
    	$provinsi = Setting::Provinsi();
    	$data = Anggota::where('anggota_id', $anggota_id)->first();
    	return view('kordinator.kelurahan.edit-kelurahan', compact('provinsi', 'data'));
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
            $input['posisi'] = 'kelurahan';
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

	    	Anggota::commit($anggota_id, $input);

	    	return redirect('kordinator/kelurahan/edit/'.$anggota_id)
	    	->with('status', 'success')
	    	->with('message', 'Berhasil mengubah data');
    	} catch (\Exception $e) {
    		return $e->getMessage();	
    	}
    }

    public function advSearch(Request $request)
    {
        $request['posisi'] = 'kelurahan';
        $data_kabkota = GSController::advancedSearch($request, 'kordinator');
        $provinsi = Setting::Provinsi();
        $data = [];
        foreach ($data_kabkota as $numb => $item) {
            $data[$numb] = $item;
            $data[$numb]['downline'] = Anggota::where('referred_by', $item->anggota_id)->where('role', 'kordinator')->count();
        }

        return view('kordinator.kelurahan.add-kelurahan', compact('data', 'provinsi'));
    }
}
