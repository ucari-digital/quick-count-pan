<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Anggota;
class SUController extends Controller
{
    public function index()
    {
    	$kabkota = Anggota::where('posisi', 'kabkota')->count();
        $kecamatan = Anggota::where('posisi', 'kecamatan')->count();
        $kelurahan = Anggota::where('posisi', 'kelurahan')->count();
    	return view('superadmin.superadmin', compact('kabkota', 'kecamatan', 'kelurahan'));
    }
}
