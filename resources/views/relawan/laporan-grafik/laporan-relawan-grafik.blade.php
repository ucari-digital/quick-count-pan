@extends('component.dashboard_layout')
@section('title')
Laporan Relawan
@endsection
@php
$auth = App\Helper\Lib::auth();
@endphp
@section('breadcrumb')
<div class="page-content__header">
	<div>
		<h2 class="page-content__header-heading">Laporan Relawan</h2>
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
		<div class="statistic-widget statistic-widget-c" style="height: 400px;">
			<div class="statistic-widget-c__heading">Statistik Relawan</div>
			<div class="statistic-widget-c__body">
				<canvas id="relawanChart"></canvas>
			</div>
		</div>
	</div>
</div>
@endsection
@section('footer')
<script>
var ctx = document.getElementById("relawanChart");
ctx.height = 300;
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: {!! App\Helper\Lib::array2string($chart['name'], true) !!},
        datasets: [{
            label: '# Relawan',
            data: {!! App\Helper\Lib::array2string($chart['value']) !!},
            backgroundColor: {!! App\Helper\Lib::color(14) !!},
        }],
        url: {!! App\Helper\Lib::array2string($chart['url'], true) !!}
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        },
        maintainAspectRatio: false,
        events: ['click'],
        onClick : function(c,i){
        	console.log(c);
        	// console.log(i);
        	var index = i[0]['_index'];
        	var url = i[0]['_chart']['config']['data']['url'][index];
        	window.location = url;
        }
    }
	});
</script>
@endsection