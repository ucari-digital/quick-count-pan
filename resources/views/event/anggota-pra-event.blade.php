@extends('component.dashboard_layout')
@php
$auth = App\Helper\Lib::auth();
@endphp
@section('breadcrumb')
<div class="page-content__header">
	<div>
		<h2 class="page-content__header-heading">Pendataan Pra Event</h2>
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
				<div class="table-responsive">
					<table class="table dtable-r">
						<thead>
							<tr>
								<th></th>
								<th>NIK</th>
								<th>NKK</th>
								<th>Nama</th>
								<th>TPT Lahir</th>
								<th>Tgl Lahir</th>
								<th>Umur</th>
								<th>Jenis Kelamin</th>
								<th>RT / RW</th>
								<th>Pilihan</th>
								<th>Bukti</th>
							</tr>
						</thead>
						<tbody>
							@foreach($data as $item)
							<tr>
								<td></td>
								<td>{{$item->no_ktp}}</td>
								<td>{{$item->no_kartu_keluarga}}</td>
								<td>{{$item->name}}</td>
								<td>{{explode(',', $item->ttl)[0]}}</td>
								<td>{{App\Helper\TimeFormat::id(explode(',', $item->ttl)[1])}}</td>
								<td>{{App\Helper\TimeFormat::age(explode(',', $item->ttl)[1])}}</td>
								<td>{{$item->jk}}</td>
								<td>{{$item->rtrw}}</td>
								<td>{{App\Model\Kandidat::find($item->kandidat_id)->name}}</td>
								<td><img src="{{url(''.$item->bukti)}}" class="rounded"></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('footer')

@endsection