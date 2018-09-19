@extends('component.dashboard_layout')
@section('breadcrumb')
<div class="page-content__header">
	<div>
		<h2 class="page-content__header-heading">Penambahan Data Pasangan Calon</h2>
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
				<form action="{{url('kandidat/submit')}}" method="post" enctype="multipart/form-data">
					@csrf
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Nama</label>
								<input type="text" name="name" class="form-control" placeholder="Nama">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Partai Pengusung</label>
								<input type="text" name="partai_pengusung" class="form-control" placeholder="Partai Pengusung">
							</div>
							<div class="form-group">
								<button class="btn btn-primary btn-block">Simpan</button>
							</div>
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