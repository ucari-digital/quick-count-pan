@extends('component.dashboard_layout')
@php
$auth = App\Helper\Lib::auth();
@endphp
@section('breadcrumb')
<div class="page-header">
	<h3 class="page-title">
	<span class="page-title-icon bg-gradient-primary text-white mr-2">
		<i class="mdi mdi-home"></i>
	</span>
	Setting Divisi Jaringan
	</h3>
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
				<form action="{{url('setting/divisi-jaringan/submit/')}}" method="post" enctype="multipart/form-data">
					@csrf
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" name="name" class="form-control" placeholder="Divisi Jaringan">
							</div>
						</div>
						<div class="col-md-6">
							<button type="submit" class="btn btn-primary btn-submit">Simpan</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table dtable-r">
						<thead>
							<tr>
								<th></th>
								<th>Divisi Jaringan</th>
								<th>Aksi</th>
							</tr>
						</thead>
						@foreach($data as $item)
						@if($item->is_deleted == null)
						<tbody>
							<tr>
								<td></td>
								<td>
									{{$item->name}}
								</td>
								<td>
									<a href="{{url('setting/divisi-jaringan/edit/'.$item->id)}}">Edit</a>
									<a href="{{url('setting/divisi-jaringan/hapus/'.$item->id)}}">hapus</a>
								</td>
							</tr>
						</tbody>
						@endif
						@endforeach
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection