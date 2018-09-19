@extends('component.dashboard_layout')
@php
$auth = App\Helper\Lib::auth();
@endphp
@section('breadcrumb')
<div class="page-content__header">
	<div>
		<h2 class="page-content__header-heading">Pengikut - {{$anggota->name}}</h2>
	</div>
	@if($auth->posisi == 'kabkota' || $auth->posisi == 'kecamatan' || $auth->posisi == 'kelurahan' || $auth->posisi == 'pusat')
	<div class="page-content__header-meta">
		<a href="{{url('kordinator/create')}}" class="btn btn-info icon-left">
			Tambah
		</a>
	</div>
	@endif
</div>
<div class="row">
	<div class="col-md-12">
		@if(session('status'))
			<div class="alert" role="alert" style="background-color: #616161; border-color: #616161;">
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
			<table class="table table-striped dtable-r">
				<thead>
					<tr>
						<th></th>
						<th>Nomor KTP</th>
						<th>Nama Lengkap</th>
						<th>No. HP</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data as $item)
					<tr>
						<td></td>
						<td>{{$item->no_ktp}}</td>
						<td>{{$item->name}}</td>
						<td>{{$item->no_hp}}</td>
						<td>
							<div class="btn-group">
								<button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Aksi
								</button>
								<div class="dropdown-menu">
									<a class="dropdown-item" href="{{url('kordinator/'.$item->posisi.'/edit/'.$item->anggota_id.'?dl=true')}}">Edit</a>
									@if($item->downline == 0)
									<a class="dropdown-item" href="{{url('/hapus/u/'.$item->anggota_id)}}">Hapus</a>
									@endif
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