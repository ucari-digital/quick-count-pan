<?php

namespace App\Http\Controllers\Relawan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Helper\Lib;
use App\Http\Controllers\GSController;

use App\Model\Anggota;
use App\Model\Provinsi;
use App\Model\Kota;
use App\Model\Kelurahan;
use App\Model\Kecamatan;
class LaporanController extends Controller
{
    public function indexKota(Request $request)
    {
        $title = 'Kabupaten / Kota';
        $provinsi = Provinsi::all();
        $data = Kota::whereIn('id', GSController::cityAvailabel())->get();
        $type = 'row';
        return view('relawan.laporan.laporan-relawan-kota', compact('provinsi', 'data', 'title', 'type'));
    }

    public function indexKecamatan(Request $request)
    {
        $title = 'Kecamatan';
        $provinsi = Provinsi::all();
        $data = Kecamatan::where('kota_id', $request->id)->get();
        $type = 'row';
        return view('relawan.laporan.laporan-relawan-kecamatan', compact('provinsi', 'data', 'title', 'type'));
    }

    public function indexKelurahan(Request $request)
    {
        $title = 'Kelurahan';
        $provinsi = Provinsi::all();
        $data = Kelurahan::where('kecamatan_id', $request->id)->get();
        $type = 'row';
    	return view('relawan.laporan.laporan-relawan-kelurahan', compact('provinsi', 'data', 'title', 'type'));
    }

    public function detail(Request $request, $field, $id)
    {
        $auth = Lib::auth();
        if ($field == 'kota') {
            $data = Anggota::where('group_id', $auth->group_id)->where('kabkota', $id)->where('role', 'relawan')->get();
        } elseif($field == 'kecamatan') {
            $data = Anggota::where('group_id', $auth->group_id)->where('kecamatan', $id)->where('role', 'relawan')->get();
        } elseif ($field == 'kelurahan') {
            $data = Anggota::where('group_id', $auth->group_id)->where('kelurahan', $id)->where('role', 'relawan')->get();
        }
        return view('relawan.laporan.laporan-relawan-detail', compact('provinsi', 'data'));
    }

    public static function rcount($field, $id_field, $jk)
    {
        $auth = Lib::auth();
        if ($field == 'kota') {
            $data = Anggota::where('group_id', $auth->group_id)
            ->where('kabkota', $id_field)
            ->where('role', 'relawan')
            ->where('jk', $jk)
            ->get();
        } elseif ($field == 'kecamatan') {
            $data = Anggota::where('group_id', $auth->group_id)
            ->where('kecamatan', $id_field)
            ->where('role', 'relawan')
            ->where('jk', $jk)
            ->get();
        } elseif ($field == 'kelurahan') {
            $data = Anggota::where('group_id', $auth->group_id)
            ->where('kelurahan', $id_field)
            ->where('role', 'relawan')
            ->where('jk', $jk)
            ->get();
        }

        return count($data);
    }
}
