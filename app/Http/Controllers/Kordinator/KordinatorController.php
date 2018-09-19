<?php

namespace App\Http\Controllers\Kordinator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\GSController;

use App\Model\Anggota;
use App\Model\Kandidat;
use App\Model\Provinsi;
use App\Model\Kelurahan;
use App\Model\Kota;
use App\Model\Slider;
use App\Model\Activity;
use App\Model\Target;
use App\Helper\TimeFormat;
use App\Helper\Lib;
class KordinatorController extends Controller
{
    public function kordinator()
    {
        $kabkota = Anggota::where('group_id', Lib::auth()->group_id)->where('posisi', 'kabkota')->count();
        $kecamatan = Anggota::where('group_id', Lib::auth()->group_id)->where('posisi', 'kecamatan')->count();
        $kelurahan = Anggota::where('group_id', Lib::auth()->group_id)->where('posisi', 'kelurahan')->count();
        $saksi = Anggota::where('group_id', Lib::auth()->group_id)->where('posisi', 'saksi')->count();
        $relawan = Anggota::where('group_id', Lib::auth()->group_id)->where('posisi', 'relawan')->count();
        $pemilih = Anggota::where('group_id', Lib::auth()->group_id)->where('posisi', 'pemilih')->count();
        $caleg = Kandidat::where('group_id', Lib::auth()->group_id)->count();
        $saksi = Anggota::where('group_id', Lib::auth()->group_id)->where('posisi', 'saksi')->count();
        $top_relawan = Anggota::where('group_id', Lib::auth()->group_id)->where('role', 'relawan')->get();
        $slider = Slider::where('group_id', Lib::auth()->group_id)->orderBy('created_at', 'DESC')->get();

        $relawan_kelurahan = [];
        foreach ($top_relawan as $numb => $item) {
            $relawan_kelurahan[Kelurahan::getName($item->kelurahan)->name]['name'] =  Kelurahan::getName($item->kelurahan)->name;
            $relawan_kelurahan[Kelurahan::getName($item->kelurahan)->name]['value'][] = $item->anggota_id;
        }

        $relawan_counter = [];
        foreach ($relawan_kelurahan as $no => $irelawan) {
            $relawan_counter[] = [
                'name' => $irelawan['name'],
                'value' => count($irelawan['value'])
            ];
        }

        // return $relawan_counter;

        $sorted = collect($relawan_counter)->sortByDesc('value');

        $t_relawan = [];
        foreach ($sorted as $to_relawan) {
            $t_relawan['name'][] = $to_relawan['name'];
            $t_relawan['value'][] = $to_relawan['value'];
        }

        /* Handle Value For Null value */
        

        if (empty($t_relawan)) {
            $t_relawan['name'][] = '';
            $t_relawan['value'][] = '';
        }

    	return view('kordinator.kordinator', compact('kabkota', 'kecamatan', 'kelurahan', 'rtrw', 'saksi', 'relawan', 'pemilih', 'caleg', 'saksi', 't_relawan', 'slider'));
    }

    public function all(Request $request)
    {
        $auth = Lib::auth();
        $data_anggota = Anggota::where('group_id', $auth->group_id)->where('role', 'kordinator')->get();

        $data = [];
        foreach ($data_anggota as $numb => $item) {
            $data[$numb] = $item;
            $data[$numb]['downline'] = Anggota::where('referred_by', $item->anggota_id)->where('role', 'kordinator')->count();
        }

        $provinsi = Provinsi::all();
        return view('kordinator.all', compact('data', 'provinsi'));
    }

    public function kabkot()
    {
    	return view('kordinator.kabkota.kabkota');
    }

    public function downline($anggota_id)
    {
    	$anggota = Anggota::where('anggota_id', $anggota_id)->first();
        $data = Anggota::where('referred_by', $anggota_id)->where('role', 'kordinator')->get();
        return view('kordinator.downline', compact('data', 'anggota'));
    }

    public function create()
    {
        $provinsi = Provinsi::all();
        return view('kordinator.add-kordinator', compact('provinsi'));
    }

    public function submit(Request $request)
    {
        try {
            $time = new TimeFormat;
            $ttl = $time->date($request->tgl_lahir)->toFormat('sys');
            $file = Storage::disk('public')->put('images/avatar', $request->foto);
            $file_name = Storage::url($file);

            if ($request->posisi == 'pusat') {
                $posisi = 'kabkota';
            }

            if ($request->posisi == 'kabkota') {
                $posisi = 'kecamatan';
            }

            if ($request->posisi == 'kecamatan') {
                $posisi = 'kelurahan';
            }

            if ($request->posisi == 'kelurahan') {
                $posisi = 'rtrw';
            }

            $input = $request;
            $input['ttl'] = $request->tempat.','.$ttl;
            $input['posisi'] = $posisi;
            $input['role'] = 'kordinator';
            $input['avatar'] = $file_name;
            $input['group_id'] = Lib::auth()->group_id;
            $input['referred_by'] = Lib::auth()->anggota_id;

            if ($posisi == 'kabkota') {
                $st = 'Kabupaten / Kota';
            } else {
                $st = ucfirst($posisi);
            }

            $anggota = Anggota::store($input);
            $field = [
                'message' => 'mendaftarkan <b>'.$anggota->name.'</b> sebagai Koordinator '.$st,
                'image' => '',
                'referrer' => $anggota->id,
                'type' => 'simpan'
            ];
            Activity::store($field);

            return redirect('kordinator/kabkota/create')
            ->with('status', 'success')
            ->with('message', 'Berhasil mendaftarkan anggota');
        } catch (\Exception $e) {
            return redirect()->back()
            ->with('status', 'failed')
            ->with('message', $e->getMessage());
        }
    }

    public function advSearch(Request $request)
    {
        $data_kabkota = GSController::advancedSearch($request, 'kordinator');
        $provinsi = Provinsi::all();
        $data = [];
        foreach ($data_kabkota as $numb => $item) {
            $data[$numb] = $item;
            $data[$numb]['downline'] = Anggota::where('referred_by', $item->anggota_id)->where('role', 'kordinator')->count();
        }

        return view('kordinator.all', compact('data', 'provinsi'));
    }
}
