<?php

namespace App\Http\Controllers\Relawan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Controllers\GSController;
use Hash;
use Carbon\Carbon;
use App\Model\Anggota;
use App\Model\Provinsi;
use App\Model\Kota;
use App\Model\Target;

use App\Helper\TimeFormat;
use App\Helper\Lib;
class RelawanController extends Controller
{
    public function relawan()
    {
        $auth = Lib::auth();
        $provinsi = Provinsi::all();
        $total_relawan = Anggota::where('group_id', $auth->group_id)->where('role', 'relawan')->count();
        $total_saksi  = Anggota::where('group_id', $auth->group_id)->where('posisi', 'saksi')->count();
        $total_relawan_p = Anggota::where('group_id', $auth->group_id)->where('role', 'relawan')->where('jk', 'P')->count();
        $total_relawan_l = Anggota::where('group_id', $auth->group_id)->where('role', 'relawan')->where('jk', 'L')->count();
        $target = Target::where('id', 1)->first();

        if ($auth->role == 'superadmin') {
            $data_anggota = Anggota::where('group_id', $auth->group_id)->where('posisi', 'relawan')->where('role', 'relawan')->get();
        } else {
            $data_anggota = Anggota::where('group_id', $auth->group_id)->where('role', 'relawan')->get();
        }

        $data = [];
        foreach ($data_anggota as $numb => $item) {
            $data[$numb] = $item;
            $data[$numb]['downline'] = Anggota::where('group_id', $auth->group_id)->where('referred_by', $item->anggota_id)->where('role', 'pemilih')->count();
        }

        $new_relawan = Anggota::where('group_id', $auth->group_id)->where('role', 'relawan')->orderBy('created_at', 'DESC')->take(10)->get();

        // Chart
        $day = Anggota::whereDate('created_at', Carbon::today())->where('role', 'relawan')->get()->groupBy(function($date){
            return Carbon::parse($date->created_at)->format('h');
        });
        $days = [];
        $status = '';
        for ($i=0; $i < 13; $i++) { 
            if ($i < 11) {
                $x = '0'.$i;
            } else {
                $x = ''.$i;
            }

            $status = false;
            foreach ($day as $numbday => $itemday) {
                if ($x == $numbday) {
                    $days['value'][] = count($itemday);
                    $days['time'][] = ''.$numbday.':00';
                    $status = true;
                }
            }
            if ($status == false) {
                $days['value'][] = 0;
                $days['time'][] = $x.':00';
            }
        }

        $start_week = Carbon::now()->startOfWeek();
        $end_week = Carbon::now()->startOfWeek()->addDays(7);
        $week = [];
        for ($i=0; $i <= 7; $i++) { 
            $start = Carbon::now()->startOfWeek()->addDays($i);
            $end = Carbon::now()->startOfWeek()->addDays($i+1);
            $week['value'][] = self::time($start, $end);
            $week['time'][] = $start->format('d');
        }

        $start_month = Carbon::now()->startOfMonth();
        $end_month = Carbon::now()->endOfMonth();
        $diff_month = $start_month->diffInDays($end_month);
        $month = [];
        for ($i=0; $i <= $diff_month; $i++) {
            $start = Carbon::now()->startOfMonth()->addDays($i); 
            $end = Carbon::now()->startOfMonth()->addDays($i+1); 
            $month['value'][] = self::time($start, $end);
            $month['time'][] = $start->format('d');
        }

        return view('relawan.relawan', compact('data', 'new_relawan', 'total_saksi', 'total_relawan', 'total_relawan_l', 'total_relawan_p', 'provinsi', 'days', 'week', 'month', 'target'));
    }

    // +++++++++++++++++++++ Static Function +++++++++++++++++++++++++

    public static function time($start_date, $end_date)
    {
        return Anggota::where('created_at', '>=', $start_date)->where('created_at', '<=', $end_date)->where('role', 'relawan')->count();
    }

    // +++++++++++++++++++ End Static Function +++++++++++++++++++++++

    public function index(Request $request)
    {
        $auth = Lib::auth();

        if ($auth->role == 'superadmin') {
            $data_anggota = Anggota::where('group_id', $auth->group_id)->where('posisi', 'relawan')->where('role', 'relawan')->get();
        } else {
            $data_anggota = Anggota::where('group_id', $auth->group_id)->where('role', 'relawan')->get();
        }

        if ($request->saksi) {
            $data_anggota = Anggota::where('posisi', 'saksi')
            ->where('group_id', Lib::auth()->group_id)
            ->where('role', 'relawan')
            ->get();
        }

        $data = [];
        foreach ($data_anggota as $numb => $item) {
            $data[$numb] = $item;
            $data[$numb]['downline'] = Anggota::where('referred_by', $item->anggota_id)->where('role', 'pemilih')->count();
        }

        $kota = Kota::whereIn('id', GSController::cityAvailabel())->get();
        $provinsi = Provinsi::all();
    	return view('relawan.data-relawan', compact('data', 'kota', 'provinsi'));
    }

    public function create()
    {
    	$provinsi = Provinsi::all();
    	return view('relawan.add-relawan', compact('provinsi'));
    }

    public function submit(Request $request)
    {
    	try {
	    	$time = new TimeFormat;
			$ttl = $time->date($request->tgl_lahir)->toFormat('sys');
			$file = Storage::disk('public')->put('images/avatar', $request->foto);
			$file_name = Storage::url($file);

			$input = $request;
			$input['ttl'] = $request->tempat.','.$ttl;
			$input['posisi'] = 'relawan';
			$input['role'] = 'relawan';
			$input['avatar'] = $file_name;
            $input['group_id'] = Lib::auth()->group_id;

	    	Anggota::store($input);

	    	return redirect()->back()
	    	->with('status', 'success')
	    	->with('message', 'Berhasil mendaftarkan anggota');
    	} catch (\Exception $e) {
    		return $e->getMessage();
    	}
    }

    public function edit($anggota_id)
    {
        $kota = Kota::whereIn('id', GSController::cityAvailabel())->get();
        $data = Anggota::where('anggota_id', $anggota_id)->first();
        return view('relawan.edit-relawan', compact('kota', 'data'));
    }

    public function update(Request $request, $anggota_id)
    {
        try {
            $anggota_data = Anggota::where('anggota_id', $anggota_id)->first();
            $time = new TimeFormat;
            $ttl = $time->date($request->tgl_lahir)->toFormat('sys');


            $input = $request;
            $input['ttl'] = $request->tempat.','.$ttl;
            $input['posisi'] = 'relawan';
            $input['role'] = 'relawan';
            $input['referred_by'] = $anggota_data->referred_by;

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
                $foto_ktp = Storage::disk('public')->put('images/ktp', $request->foto_ktp);
                $foto_name_ktp = Storage::url($foto_ktp);
                $input['fktp'] = $foto_name_ktp;
            }

            if (empty($request->password)) {
                $input['password'] = $anggota_data->password;
            } else {
                $input['password'] = Hash::make($request->password);    
            }


            
            Anggota::commit($anggota_id, $input);

            return redirect()->back()
            ->with('status', 'success')
            ->with('message', 'Berhasil mendaftarkan anggota');
        } catch (\Exception $e) {
            return $e->getMessage();    
        }
    }

    public function relawanSearch(Request $request)
    {
        // return $request;
        $auth = Lib::auth();
        $anggota = Anggota::when($request->nama, function($query) use ($request){
            return $query->where('name', 'like', '%'.$request->nama.'%');  
        })
        ->when($request->email, function($query) use ($request){
            return $query->where('email', 'like',  '%'.$request->email.'%');
        })
        ->when($request->jk, function($query) use ($request){
            return $query->where('jk', $request->jk);
        })
        ->when($request->provinsi, function($query) use ($request){
            return $query->where('provinsi', $request->provinsi);
        })
        ->when($request->kecamatan, function($query) use ($request){
            return $query->where('kecamatan', $request->kecamatan);
        })
        ->when($request->kabkota, function($query) use ($request){
            return $query->where('kabkota', $request->kabkota);
        })
        ->when($request->kelurahan, function($query) use ($request){
            return $query->where('kelurahan', $request->kelurahan);
        })
        ->when($request->rt, function($query) use ($request){
            return $query->where('rtrw', 'like', $request->rt.'%');
        })
        ->when($request->rw, function($query) use ($request){
            return $query->where('rtrw', 'like', '%'.$request->rw);
        })
        ->when($request->role, function($query) use ($request){
            return $query->where('posisi', $request->role);
        })
        ->where('role', 'relawan')
        ->where('group_id', $auth->group_id)
        ->get();


        if ($auth->role == 'superadmin') {
            $data_anggota = Anggota::where('posisi', 'relawan')->where('role', 'relawan')->get();
        } else {
            $data_anggota = $anggota;
        }

        if ($request->saksi) {
            $data_anggota = Anggota::where('posisi', 'saksi')
            ->where('group_id', Lib::auth()->group_id)
            ->where('role', 'relawan')
            ->get();
        }

        $data = [];
        foreach ($data_anggota as $numb => $item) {
            $data[$numb] = $item;
            $data[$numb]['downline'] = Anggota::where('referred_by', $item->anggota_id)->where('role', 'pemilih')->count();
        }

        $kota = Kota::whereIn('id', GSController::cityAvailabel())->get();
        $provinsi = Provinsi::all();
        return view('relawan.data-relawan', compact('data', 'kota', 'provinsi'));
    }
}
