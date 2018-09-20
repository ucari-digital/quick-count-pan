<?php

namespace App\Http\Controllers\Activity;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Model\Activity;

use App\Helper\FileUpload;
use App\Helper\Lib;
class KegiatanController extends Controller
{
    
	public function index()
	{
		$data = Activity::where('group_id', Lib::auth()->group_id)->where('type', 'kegiatan')->orderBy('created_at', 'DESC')->get();

		return view('kegiatan.kegiatan', compact('data'));
	}

	public function create()
	{
		return view('kegiatan.add-kegiatan');
	}

	public function submit(Request $request)
	{
		try {
			$file_upload = FileUpload::foto($request, 'foto');

			if ($file_upload == 'failed') {
	            return redirect()->back()
	            ->with('status', 'failed')
	            ->with('message', 'Tipe data yang diupload tidak didukung');
	        }

	        $file = Storage::disk('public')->put('images/activity', $request->foto);
	        $file_name = Storage::url($file);

			$request['message'] = $request->keterangan;
			$request['image'] = $file_name.',';
			$request['referrer'] = '';
			$request['type'] = 'kegiatan';
			$activity = Activity::store($request);
			return redirect('activity/kegiatan/edit/'.$activity->id)
	        ->with('status', 'success')
	        ->with('message', 'Gambar berhasil ditambahkan');
		} catch (\Exception $e) {
			return $e->getMessage();
		}
	}

	public function edit($id)
	{
		$data = Activity::where('id', $id)->where('group_id', Lib::auth()->group_id)->where('type', 'kegiatan')->first();
		$image_not_filter = explode(',', $data->image);
		$image = array_values(array_filter($image_not_filter));
		return view('kegiatan.edit-kegiatan', compact('data', 'image'));
	}

	public function update(Request $request, $id)
	{
		$file_upload = FileUpload::foto($request, 'foto');

		if ($file_upload == 'failed') {
            return redirect()->back()
            ->with('status', 'failed')
            ->with('message', 'Tipe data yang diupload tidak didukung');
        }

        $file = Storage::disk('public')->put('images/activity', $request->foto);
        $file_name = Storage::url($file);
	        
		$data = Activity::where('id', $id)->where('group_id', Lib::auth()->group_id)->where('type', 'kegiatan')->first();
		$arr_img = explode(',', $data->image);
		$collection = collect($arr_img);
		$collection->push($file_name);
		$collection->all();

		$add_arr = array_values(array_filter($collection->all()));
		$res_image_arr = implode(',', $add_arr);

		Activity::where('id', $id)->update([
			'image' => $res_image_arr.','
		]);

		return redirect()->back()
        ->with('status', 'success')
        ->with('message', 'Gambar berhasil ditambahkan');
	}

	public function delete($id, $param)
	{
		$name = decrypt($param);
		$data = Activity::where('id', $id)->where('group_id', Lib::auth()->group_id)->where('type', 'kegiatan')->first();
		$res_image_replacter = str_replace($name.',', '', $data->image);

		Activity::where('id', $id)->update([
			'image' => $res_image_replacter.','
		]);

		return redirect()->back()
        ->with('status', 'success')
        ->with('message', 'Berhasil menghapus gambar');
	}
}
