@extends('component.dashboard_layout')
@section('title')
Laporan Relawan Detail
@endsection
@php
$auth = App\Helper\Lib::auth();
@endphp
@section('breadcrumb')
<div class="page-content__header">
	<div>
		<h2 class="page-content__header-heading">Laporan Relawan Detail</h2>
	</div>
	@if($auth->posisi == 'kelurahan')
	<div class="page-content__header-meta">
		<a href="{{url('relawan/create')}}" class="btn btn-info icon-left">
			Tambah
		</a>
	</div>
	@endif
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
			<table class="table table-striped dtable-r">
			<thead>
				<tr>
					<td>No. KK</td>
					<td>No. KTP</td>
					<td>Nama</td>
					<td>Jenis Kelamin</td>
					<td>TGL. Lahir</td>
					<td>Kecamatan</td>
					<td>Kelurahan</td>
				</tr>
			</thead>
			<tbody>
				@foreach($data as $item)
				<tr>
					<td>{{$item->no_kartu_keluarga}}</td>
					<td>{{$item->no_ktp}}</td>
					<td>{{$item->name}}</td>
					@if($item->jk == 'L')
					<td style="width: 120px">Laki - Laki</td>
					@else
					<td style="width: 120px">Perempuan</td>
					@endif
					<td>{{App\Helper\TimeFormat::id(explode(',', $item->ttl)[1])}}</td>
					<td>{{App\Model\Kecamatan::getName($item->kecamatan)->name}}</td>
					<td>{{App\Model\Kelurahan::getName($item->kelurahan)->name}}</td>
				</tr>
				@endforeach
			</tbody>
			</table>
		</div>
	</div>
</div>
@endsection
@section('footer')
@endsection