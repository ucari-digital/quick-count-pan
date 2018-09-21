<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Auth Routing
 */
Route::prefix('/')->group(function(){
	Route::get('/', function(){
		return redirect('login');
	});
	Route::get('login', 'Auth\LoginController@index');
	Route::post('login/submit', 'Auth\LoginController@submit');
});


/**
 * Relawan
 */
Route::middleware(['anggota'])->group(function(){
	Route::get('superadmin', 'Superadmin\SUController@index');

	Route::prefix('kordinator')->group(function(){
		Route::get('/', 'Kordinator\KordinatorController@kordinator');
		Route::get('/all', 'Kordinator\KordinatorController@all');
		Route::post('/all/search', 'Kordinator\KordinatorController@advSearch');
		Route::get('/dl/{anggota_id}', 'Kordinator\KordinatorController@downline');
		Route::get('create', 'Kordinator\KordinatorController@create');
		Route::post('submit', 'Kordinator\KordinatorController@submit');
		
		Route::prefix('kabkota')->group(function(){
			Route::get('/', 'Kordinator\KabKotaController@index');
			Route::get('/create', 'Kordinator\KabKotaController@create');
			Route::post('/create/submit', 'Kordinator\KabKotaController@submit');
			Route::get('/edit/{anggota_id}', 'Kordinator\KabKotaController@edit');
			Route::post('/update/{anggota_id}', 'Kordinator\KabKotaController@update');
			Route::post('/search', 'Kordinator\KabKotaController@advSearch');
		});

		Route::prefix('kecamatan')->group(function(){
			Route::get('/', 'Kordinator\KecamatanController@index');
			Route::get('/create', 'Kordinator\KecamatanController@create');
			Route::post('/create/submit', 'Kordinator\KecamatanController@submit');
			Route::get('/edit/{anggota_id}', 'Kordinator\KecamatanController@edit');
			Route::post('/update/{anggota_id}', 'Kordinator\KecamatanController@update');
			Route::post('/search', 'Kordinator\KecamatanController@advSearch');
		});

		Route::prefix('kelurahan')->group(function(){
			Route::get('/', 'Kordinator\KelurahanController@index');
			Route::get('/create', 'Kordinator\KelurahanController@create');
			Route::post('/create/submit', 'Kordinator\KelurahanController@submit');
			Route::get('/edit/{anggota_id}', 'Kordinator\KelurahanController@edit');
			Route::post('/update/{anggota_id}', 'Kordinator\KelurahanController@update');
			Route::post('/search', 'Kordinator\KelurahanController@advSearch');
		});

		Route::prefix('tps')->group(function(){
			Route::get('/', 'Kordinator\TPSController@index');
			Route::get('/create', 'Kordinator\TPSController@create');
			Route::post('/create/submit', 'Kordinator\TPSController@submit');
			Route::get('/edit/{anggota_id}', 'Kordinator\TPSController@edit');
			Route::post('/update/{anggota_id}', 'Kordinator\TPSController@update');
			Route::post('/search', 'Kordinator\TPSController@advSearch');
		});

		Route::prefix('pusat')->group(function(){
			Route::get('/', 'Kordinator\PusatController@index');
			Route::get('/create', 'Kordinator\PusatController@create');
			Route::post('/create/submit', 'Kordinator\PusatController@submit');
			Route::get('/edit/{anggota_id}', 'Kordinator\PusatController@edit');
			Route::post('/update/{anggota_id}', 'Kordinator\PusatController@update');
			Route::post('/search', 'Kordinator\PusatController@advSearch');
		});

		Route::prefix('rtrw')->group(function(){
			Route::get('/', 'Kordinator\RTRWController@index');
			Route::get('/create', 'Kordinator\RTRWController@create');
			Route::post('/create/submit', 'Kordinator\RTRWController@submit');
			Route::get('/edit/{anggota_id}', 'Kordinator\RTRWController@edit');
			Route::post('/update/{anggota_id}', 'Kordinator\RTRWController@update');
			Route::post('/search', 'Kordinator\RTRWController@advSearch');
		});
	});

	Route::prefix('relawan')->group(function(){
		Route::get('/', 'Relawan\RelawanController@relawan');
		Route::get('/data/{saksi?}', 'Relawan\RelawanController@index');
		Route::get('/create', 'Relawan\RelawanController@create');
		Route::post('/submit', 'Relawan\RelawanController@submit');
		Route::get('/edit/{anggota_id}', 'Relawan\RelawanController@edit');
		Route::post('/update/{anggota_id}', 'Relawan\RelawanController@update');
		Route::post('/search', 'Relawan\RelawanController@relawanSearch');
		Route::prefix('laporan')->group(function(){
			Route::get('kota/{type}', 'Relawan\LaporanController@indexKota');
			Route::get('kecamatan/{id}/{type}', 'Relawan\LaporanController@indexKecamatan');
			Route::get('kelurahan/{id}/{type}', 'Relawan\LaporanController@indexKelurahan');

			Route::get('detail/{field}/{id}/{type}', 'Relawan\LaporanController@detail');

			// Grafik
			Route::get('grafik/{field}/{id?}', 'Relawan\LaporanGrafikController@index');
		});
	});

	Route::prefix('pemilih')->group(function(){
		Route::get('/', 'Pemilih\PemilihController@pemilih');
		Route::get('/data', 'Pemilih\PemilihController@index');
		Route::get('/create', 'Pemilih\PemilihController@create');
		Route::post('/submit', 'Pemilih\PemilihController@submit');
		Route::get('/edit/{anggota_id}', 'Pemilih\PemilihController@edit');
		Route::post('/update/{anggota_id}', 'Pemilih\PemilihController@update');
	});

	Route::prefix('kandidat')->group(function(){
		Route::get('/', 'Kandidat\KandidatController@index');
		Route::get('/create', 'Kandidat\KandidatController@create');
		Route::post('/submit', 'Kandidat\KandidatController@submit');
		Route::get('/edit/{id}', 'Kandidat\KandidatController@edit');
		Route::post('/update/{id}', 'Kandidat\KandidatController@update');
		Route::get('/hapus/{id}', 'Kandidat\KandidatController@hapus');
	});

	Route::prefix('dpt')->group(function(){
		Route::get('/', 'DPT\DPTController@provinsi');
		Route::get('/kabkota/{id}', 'DPT\DPTController@kabkota');
		Route::get('/kecamatan/{id}', 'DPT\DPTController@kecamatan');
		Route::get('/kelurahan/{id}', 'DPT\DPTController@kelurahan');
		Route::get('/anggota/{id}', 'DPT\DPTController@anggota');
		Route::get('/import', 'DPT\DPTController@import');
		Route::post('/upload', 'DPT\DPTController@upload');
		Route::get('/download', function(){
			return response()->download('storage/excel-template/Template-DPT.xlsx');
		});
	});

	Route::prefix('event')->group(function(){
		// Pra event
		// Route::get('pendataan/pra-event/{title}/{id?}', 'Event\PendataanController@praEvent');
		// Route::get('pendataan/anggota/pra-event/{id}', 'Event\PendataanController@praEventAnggota');

		// Input
		Route::get('pendataan/input/pra-event/', 'Event\PendataanController@praEventInput');
		Route::post('pendataan/input/pra-event/submit', 'Event\PendataanController@praEventSubmit');
		Route::get('hasil-pendataan/pra/', 'Event\PraEventController@index');
		Route::get('hasil-pendataan/pra/kecamatan/{id}', 'Event\PraEventController@kecamatan');
		Route::get('hasil-pendataan/pra/kelurahan/{id}', 'Event\PraEventController@kelurahan');
		
		// Event
		Route::get('pendataan/input/event/', 'Event\PendataanController@event');
		Route::post('pendataan/input/event/submit', 'Event\PendataanController@eventSubmit');
		ROute::get('hasil-pendataan/detail', 'Event\EventController@detail');
		ROute::get('hasil-pendataan/detail/chart', 'Event\EventController@chartDetail');
		ROute::get('hasil-pendataan/{data_lokasi?}/{lokasi_id?}', 'Event\EventController@index');
	});

	Route::prefix('saksi')->group(function(){
		Route::post('create', 'Saksi\SaksiController@create');
		Route::get('delete/{anggota_id}', 'Saksi\SaksiController@delete');
	});

	Route::prefix('setting')->group(function(){
		Route::get('divisi-jaringan', 'SettingController@divisiJaringan');
		Route::post('divisi-jaringan/submit', 'SettingController@divisiJaringanSubmit');
		Route::get('divisi-jaringan/edit/{id}', 'SettingController@divisiJaringanEdit');
		Route::post('divisi-jaringan/update/{id}', 'SettingController@divisiJaringanUpdate');
		Route::get('divisi-jaringan/hapus/{id}', 'SettingController@divisiJaringanDelete');
	});

	Route::prefix('activity')->group(function(){
		Route::get('/', 'Activity\ActivityController@index');

		// Kegiatan
		Route::get('kegiatan', 'Activity\KegiatanController@index');
		Route::get('kegiatan/create', 'Activity\KegiatanController@create');
		Route::post('kegiatan/submit', 'Activity\KegiatanController@submit');
		Route::get('kegiatan/edit/{id}', 'Activity\KegiatanController@edit');
		Route::post('kegiatan/update/{id}', 'Activity\KegiatanController@update');
		Route::get('kegiatan/delete/{id}/{param}', 'Activity\KegiatanController@delete');
	});

	Route::prefix('setting')->group(function(){
		Route::get('slider', 'Setting\SliderController@index');
		Route::post('slider/create', 'Setting\SliderController@create');
		Route::get('slider/delete/{id}', 'Setting\SliderController@delete');

		Route::get('target', 'Setting\TargetController@index');
		Route::post('target/store', 'Setting\TargetController@store');
	});

	/* 
	 * Global ROuting
	 */
	Route::get('profil', 'GController@profil');
	Route::post('profil/update/{anggota_id}', 'GController@profilUpdate');
	Route::get('dl/{role}/{anggota_id}', 'GController@downline');
	Route::get('hapus/u/{anggota_id}', 'GController@hapusAnggota');
	Route::get('anggota/{anggota_id}', 'GController@anggota');
	Route::get('pencarian-anggota', 'GController@pencarianAnggota');
	Route::get('chart-kandidat', 'GController@chartKandidat');
	Route::get('search_anggota/{nik}', 'GController@searchAnggota');
	Route::get('logout', 'GController@logout');
});

Route::get('kota/{id}', 'GController@kota');
Route::get('kecamatan/{id}', 'GController@kecamatan');
Route::get('kelurahan/{id}', 'GController@kelurahan');
Route::get('wilayah', 'GController@wilayah');


