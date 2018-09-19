@extends('component.dashboard_layout')
@section('breadcrumb')
<div class="page-content__header">
	<div>
		<h2 class="page-content__header-heading">Dashboard</h2>
	</div>
</div>
@endsection
@section('content')
<div class="row">
	<div class="col-md-3">
		<div class="card bg-gradient-danger text-white text-center">
			<div class="card-body">
				<h1>{{$kabkota}}</h1>
				<span>Relawan Kab/Kota</span>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card bg-gradient-info text-white text-center">
			<div class="card-body">
				<h1>{{$kecamatan}}</h1>
				<span>Relawan Kec</span>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card bg-gradient-success text-white text-center">
			<div class="card-body">
				<h1>{{$kelurahan}}</h1>
				<span>Relawan Kel</span>
			</div>
		</div>
	</div>
</div>
@endsection