<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Helper\Lib;
use App\Model\Anggota;
use App\Model\QuicCount;
use App\Model\Kandidat;
class GSController extends Controller
{
    /**
     * Global Static Controller Class
     */
    public static function cityAvailabel()
    {
    	$city = [3275, 3276];
    	return $city;
    }

    public static function advancedSearch($request, $role)
    {
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
        ->when($request->posisi, function($query) use ($request){
            return $query->where('posisi', $request->posisi);
        })
        ->where('role', $role)
        ->where('group_id', $auth->group_id)
        ->get();

        return $anggota;
    }
}
