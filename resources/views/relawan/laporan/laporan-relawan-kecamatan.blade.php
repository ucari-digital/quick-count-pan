@extends('component.dashboard_layout')
@if($type == 'row')
	@section('title')
	Laporan Relawan Kecamatan
	@endsection
	@php
	$auth = App\Helper\Lib::auth();
	@endphp
	@section('breadcrumb')
	<div class="page-content__header">
		<div>
			<h2 class="page-content__header-heading">Laporan Relawan Kecamatan</h2>
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
				<table class="table table-striped dtable-r">
				<thead>
					<tr>
						<td rowspan="2">{{$title}}</td>
						<td colspan="3" class="text-center">Jumlah Relawan</td>
					</tr>
					<tr>
						<td>L</td>
						<td>P</td>
						<td>Total</td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					@foreach($data as $item)
					<tr>
						<td><a href="{{url('relawan/laporan/kelurahan/'.$item->id.'/row')}}">{{$item['name']}}</a></td>
						<td>{{App\Http\Controllers\Relawan\LaporanController::rcount('kecamatan', $item->id, 'L')}}</td>
						<td>{{App\Http\Controllers\Relawan\LaporanController::rcount('kecamatan', $item->id, 'P')}}</td>
						<td>{{App\Http\Controllers\Relawan\LaporanController::rcount('kecamatan', $item->id, 'L') + App\Http\Controllers\Relawan\LaporanController::rcount('kecamatan', $item->id, 'P')}}</td>
						<td><a href="{{url('relawan/laporan/detail/kecamatan/'.$item->id.'/row')}}" class="btn btn-sm btn-primary">Detail</a></td>
					</tr>
					@endforeach
				</tbody>
				</table>
			</div>
		</div>
	</div>
	@endsection
@endif
	@section('footer')
@endsection