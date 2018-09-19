@extends('component.dashboard_layout')
@section('breadcrumb')
<div class="page-content__header">
	<div>
		<h2 class="page-content__header-heading">Penambahan Kordinator</h2>
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
				<form action="{{url('setting/target/store')}}" method="post" enctype="multipart/form-data">
					@csrf
					<div class="row">
						<div class="col-md-5">
							<div class="form-group">
								<label>Target Relawan</label>
								<input type="text" name="relawan" class="form-control" value="{{$data->relawan}}">
							</div>
						</div>
						<div class="col-md-5">
							<div class="form-group">
								<label>Target Pemilih</label>
								<input type="text" name="pemilih" class="form-control" value="{{$data->pemilih}}">
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