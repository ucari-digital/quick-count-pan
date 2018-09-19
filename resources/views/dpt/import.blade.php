@extends('component.dashboard_layout')
@php
$auth = App\Helper\Lib::auth();
@endphp
@section('breadcrumb')
<div class="page-content__header">
	<div>
		<h2 class="page-content__header-heading">Upload DPT</h2>
	</div>
	<div class="page-content__header-meta">
		<a href="{{url('dpt/download')}}" class="btn btn-info icon-left">
			Download Template DPT
		</a>
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
				<form action="{{url('dpt/upload')}}" method="post" enctype="multipart/form-data">
					@csrf
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<input type="file" name="excel" class="form-control">
							</div>
						</div>
						<div class="col-md-6">
							<button type="submit" href="{{url('')}}" class="btn btn-primary btn-submit">Upload</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection