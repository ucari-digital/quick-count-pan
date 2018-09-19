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
				<h1>{{$data}}</h1>
				<span>Pemilih Direkrut</span>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="card bg-gradient-info text-white text-center">
			<div class="card-body">
				<h1>{{$total_pemilih}}</h1>
				<span>Jumlah Pemilih</span>
			</div>
		</div>
	</div>
</div>
@endsection