@extends('component.dashboard_layout')
@php
$auth = App\Helper\Lib::auth();
@endphp
@section('breadcrumb')
<div class="page-content__header">
	<div>
		<h2 class="page-content__header-heading">Data Pasangan Calon</h2>
	</div>
	<div class="page-content__header-meta">
		<a href="{{url('kandidat/create')}}" class="btn btn-info icon-left">
			Tambah
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
		<div class="m-datatable">
			<table class="table dtable-r">
				<thead>
					<tr>
						<th></th>
						<th>Nama</th>
						<th>Partai Pengusung</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data as $item)
					<tr>
						<td></td>
						<td>{{$item->name}}</td>
						<td>{{$item->partai_pengusung}}</td>
						<td>
							<div class="btn-group">
								<button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Aksi
								</button>
								<div class="dropdown-menu">
									<a class="dropdown-item" href="{{url('kandidat/edit/'.$item->id)}}">Edit</a>
									<a class="dropdown-item" href="{{url('kandidat/hapus/'.$item->id)}}">Hapus</a>
								</div>
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection