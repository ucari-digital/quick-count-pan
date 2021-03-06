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
		<div class="m-datatable">
			<div class="table-responsive">
				<table class="table" id="dtable-r">
					<thead>
						<tr>
							<th>{{$title}}</th>
							<th>Pemilih</th>
							<th>Statistik Pemilih</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($data_set as $item)
						<tr>
							<td>{{$item->name}}</td>
							<td>
								<table class="table table-striped">
									<tr>
										<td>Jumlah Pemilih</td>
										<td>{{$item->pemilih}}</td>
									</tr>
									<tr>
										<td>Suara Masuk</td>
										<td>{{$item->suara_masuk}}</td>
									</tr>
									<tr>
										<td>Bukti Terunggah</td>
										<td>{{$item->bukti}}</td>
									</tr>
								</table>
							</td>
							<td>
								<div class="d-block" style="width: 200px; height: 200px;">
									<canvas class="myChart-{{$item->id}}" width="100" height="100"></canvas>
								</div>
							</td>
							<td>
								<a href="{{url($button_url.$item->id)}}" class="btn btn-primary">{{$button_text}}</a>
							</td>
						</tr>
						<script type="text/javascript">
							var ctx = document.getElementsByClassName("myChart-{{$item->id}}");
							var myDoughnutChart = new Chart(ctx, {
						    	type: 'doughnut',
							    data: {
							      labels: ["Jumlah Pemilih", "Suara Masuk", "Bukti Terunggah"],
							      datasets: [
							        {
							          label: "Statistik Pemilih",
							          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f"],
							          data: [{{$item->pemilih}},{{$item->suara_masuk}},{{$item->bukti}}]
							        }
							      ]
							    },
							    options: {
							      title: {
							        display: false,
							        text: ''
							      }
							    }
							});
						</script>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection
@section('footer')

@endsection