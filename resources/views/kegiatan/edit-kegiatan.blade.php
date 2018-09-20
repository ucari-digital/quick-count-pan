@extends('component.dashboard_layout')
@section('breadcrumb')
<div class="page-content__header">
	<div>
		<h2 class="page-content__header-heading">Aktivitas Distribusi APK</h2>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		@if(session('status') == 'success')
			<div class="alert alert-success" role="alert">
				{{session('message')}}
			</div>
		@elseif(session('status') == 'failed')
			<div class="alert alert-danger" role="alert">
				{{session('message')}}
			</div>
		@endif
	</div>
</div>
@endsection
@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<form action="{{url('activity/kegiatan/update/'.$data->id)}}" method="post" enctype="multipart/form-data">
					@csrf
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Keterangan Kegiatan</label>
								<textarea class="form-control">{{$data->message}}</textarea>
							</div>
						</div>
					</div>	
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Gambar Kegiatan</label>
								<input type="file" name="foto" class="form-control">
							</div>
						</div>
					</div>	
					<div class="row">
						<div class="col-md-2">
							<label>&nbsp;</label>
							<button type="submit" class="btn btn-primary btn-block">Simpan</button>
						</div>
					</div>			
				</form>
				<div class="row mt-4">
					@foreach($image as $item)
					<div class="col-md-4">
						<div class="statistic-widget statistic-widget-d" style="height: 200px">
							<div class="statistic-widget-d__body p-0">
								<img src="{{url($item)}}" style="width: 100%;">
							</div>
							<a href="{{url('activity/kegiatan/delete/'.$data->id.'/'.encrypt($item))}}" class="statistic-widget-d__link">Hapus</a>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('footer')
@endsection