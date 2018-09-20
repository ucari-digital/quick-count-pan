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
				<form action="{{url('activity/kegiatan/submit')}}" method="post" enctype="multipart/form-data">
					@csrf
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Keterangan Kegiatan</label>
								<textarea name="keterangan" class="form-control"></textarea>
							</div>
						</div>
						<div class="col-md-5">
							<div class="form-group">
								<label>Gambar Kegiatan</label>
								<input type="file" name="foto" class="form-control">
							</div>
						</div>
						<div class="col-md-2">
							<label>&nbsp;</label>
							<button type="submit" class="btn btn-primary btn-block">Simpan</button>
						</div>
					</div>					
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@section('footer')
@endsection