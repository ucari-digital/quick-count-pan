<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Hash;
class Anggota extends Authenticatable
{
    protected $table = 'anggota';
    protected $hidden = [
        'password'
    ];
    public static function store($r)
    {
    	$field = new self;
        $field->group_id = $r->group_id;
    	$field->anggota_id = $r->anggota_id;
        $field->referred_by = $r->referred_by;
    	$field->name = $r->name;
    	$field->email = $r->email;
    	$field->password = Hash::make($r->password);
        $field->no_ktp = $r->no_ktp;
    	$field->no_kartu_keluarga = $r->no_kk;
    	$field->jk = $r->jk;
    	$field->ttl = $r->ttl;
    	$field->alamat = $r->alamat;
    	$field->provinsi = $r->provinsi;
    	$field->kabkota = $r->kabkota;
    	$field->kecamatan = $r->kecamatan;
    	$field->kelurahan = $r->kelurahan;
    	$field->rtrw = $r->rtrw;
        $field->tps = $r->tps;
    	$field->agama = $r->agama;
    	$field->pekerjaan = $r->pekerjaan;
    	$field->no_hp = $r->no_hp;
    	$field->no_wa = $r->no_wa;
    	$field->divisi_jaringan = $r->divisi_jaringan;
    	$field->foto = $r->avatar;
        $field->foto_ktp = $r->fktp;
    	$field->posisi = $r->posisi;
    	$field->role = $r->role;
    	$field->save();
    	return $field;
    }

    public static function commit($id,$r)
    {
    	$field = self::where('anggota_id', $id)->update(
    	[
	    	'anggota_id' => $r->anggota_id,
            'referred_by' => $r->referred_by,
	    	'name' => $r->name,
	    	'email' => $r->email,
	    	'password' => $r->password,
	    	'no_ktp' => $r->no_ktp,
	    	'jk' => $r->jk,
	    	'ttl' => $r->ttl,
	    	'alamat' => $r->alamat,
	    	'provinsi' => $r->provinsi,
	    	'kabkota' => $r->kabkota,
	    	'kecamatan' => $r->kecamatan,
	    	'kelurahan' => $r->kelurahan,
	    	'rtrw' => $r->rtrw,
            'tps' => $r->tps,
	    	'agama' => $r->agama,
	    	'pekerjaan' => $r->pekerjaan,
	    	'no_hp' => $r->no_hp,
	    	'no_wa' => $r->no_wa,
	    	'divisi_jaringan' => $r->divisi_jaringan,
	    	'foto' => $r->avatar,
            'foto_ktp' => $r->fktp,
	    	'posisi' => $r->posisi,
	    	'role' => $r->role
    	]);
    	return $field;
    }

    public static function detail($r)
    {
        return self::where('anggota_id', $r)->first();
    }
}
