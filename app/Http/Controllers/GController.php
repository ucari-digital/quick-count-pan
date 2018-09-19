<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Storage;
use Hash;
use App\Helper\Lib;
use App\Helper\TimeFormat;
use App\Helper\FileUpload;
use App\Model\Anggota;
use App\Model\Provinsi;
use App\Model\Kota;
use App\Model\Kecamatan;
use App\Model\Kelurahan;
use App\Model\Kandidat;
use App\Model\QuicCount;
use App\Model\Activity;
class GController extends Controller
{
    public function profil()
    {
        $provinsi = Provinsi::all();
        $data = Anggota::where('anggota_id', Lib::auth()->anggota_id)->first();
        return view('page.profil', compact('data', 'provinsi'));
    }

    public function profilUpdate(Request $request, $anggota_id)
    {
        try {
            $anggota_data = Anggota::where('anggota_id', $anggota_id)->first();
            $time = new TimeFormat;
            $ttl = $time->date($request->tgl_lahir)->toFormat('sys');


            $input = $request;
            $input['ttl'] = $request->tempat.','.$ttl;
            $input['posisi'] = Lib::auth()->posisi;
            $input['role'] = Lib::auth()->role;

            $file_upload = FileUpload::foto($request, 'foto');

            if ($file_upload == 'failed') {
                return redirect()->back()
                ->with('status', 'failed')
                ->with('message', 'Tipe data yang diupload tidak didukung');
            }

            if (empty($request->foto)) {
                $input['avatar'] = $anggota_data->foto;
            } else {
                $file = Storage::disk('public')->put('images/avatar', $request->foto);
                $file_name = Storage::url($file);
                $input['avatar'] = $file_name;
            }

            if (empty($request->password)) {
                $input['password'] = $anggota_data->password;
            } else {
                $input['password'] = Hash::make($request->password);    
            }

            
            $anggota = Anggota::commit($anggota_id, $input);

            return redirect()->back()
            ->with('status', 'success')
            ->with('message', 'Berhasil mengubah data');
        } catch (\Exception $e) {
            return $e->getMessage();    
        }
    }

    public function hapusAnggota($anggota_id)
    {
    	// Cek downline
    	$dl = Anggota::where('referred_by', $anggota_id)->first();

    	if ($dl) {
    		return redirect()
    		->back()
    		->with('status', 'failed')
    		->with('message', 'Akun ini memiliki pengikut');
    	} else {
    		Anggota::where('anggota_id', $anggota_id)->delete();
    		return redirect()
    		->back()
    		->with('status', 'success')
    		->with('message', 'Anggota berhasil dihapus');
    	}
    }

    public function downline($role, $anggota_id)
    {
        $anggota = Anggota::where('anggota_id', $anggota_id)->first();
        $data = Anggota::where('referred_by', $anggota_id)->where('role', $role)->get();
        return view('page.downline', compact('data', 'anggota', 'role'));
    }

    public function wilayah()
    {
        $provinsi = $provinsi = Provinsi::all();
        return view('page.wilayah', compact('provinsi'));
    }

    public function kota($id)
    {
        $data = Kota::where('province_id', $id)->get();
        return $data;
    }

    public function kecamatan($id)
    {
    	$data = Kecamatan::where('kota_id', $id)->get();
    	return $data;
    }

    public function kelurahan($id)
    {
    	$data = Kelurahan::where('kecamatan_id', $id)->get();
    	return $data;
    }

    public function anggota($anggota_id)
    {
        $data = Anggota::where('referred_by', $anggota_id)->get();
        return $data;
    }

    public function logout()
    {
        Auth::guard('anggota')->logout();
        return redirect('login');
    }

    /**
     * Pencarian User
     */

    public function pencarianAnggota(Request $request)
    {
        $data = Anggota::where('no_ktp', $request->nik)->where('role', 'pemilih')->first();
        return $data;
    }

    public function chartKandidat()
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
        foreach ($anggota as $numb => $arr_item) {
            $arr_anggota['name'][$numb] = $arr_item['kandidat']; 
            $arr_anggota['suara'][$numb] = $arr_item['suara'];
            $arr_anggota['color'][$numb] = $arr_item['color'];
        }

        return $arr_anggota;
    }

    public function searchAnggota($nik)
    {
        return Anggota::where('no_ktp', $nik)->where('group_id', Lib::auth()->group_id)->first();
    }
    
}
