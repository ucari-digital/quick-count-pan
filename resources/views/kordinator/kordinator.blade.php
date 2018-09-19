@extends('component.dashboard_layout')
@section('breadcrumb')
@php
$auth = App\Helper\Lib::auth();
@endphp
<div class="page-content__header">
	<div>
		<h2 class="page-content__header-heading">Dashboard</h2>
	</div>
</div>
@endsection
@section('content')
<div class="row mb-4">
	<div class="col-md-12">
		<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner">
				@foreach($slider as $numb => $item)
				@if($numb == 0)
				<div class="carousel-item active">
					<img class="d-block w-100" src="{{url($item->image)}}" style="height: 300px" alt="First slide">
				</div>
				@else
				<div class="carousel-item">
					<img class="d-block w-100" src="{{url($item->image)}}" style="height: 300px" alt="First slide">
				</div>
				@endif
				@endforeach
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xl-3 col-lg-3 col-md-6">
		@if($auth->posisi == 'kabkota' || $auth->posisi == 'pusat' || $auth->posisi == 'superadmin')
		<div class="widget widget-alpha widget-alpha--color-amaranth js-link" data-link="{{url('kordinator/kabkota')}}">
		@else
		<div class="widget widget-alpha widget-alpha--color-amaranth">
		@endif
			<div>
				<div class="widget-alpha__amount">{{$kabkota}} Orang</div>
				<div class="widget-alpha__description">Kordinator Kota</div>
			</div>
			<span class="widget-alpha__icon ua-icon-widget-user"></span>
		</div>
	</div>
	<div class="col-xl-3 col-lg-3 col-md-6">
		@if($auth->posisi == 'kecamatan' || $auth->posisi == 'kabkota' || $auth->posisi == 'pusat' || $auth->posisi == 'superadmin')
		<div class="widget widget-alpha widget-alpha--color-green-jungle js-link" data-link="{{url('kordinator/kecamatan')}}">
		@else
		<div class="widget widget-alpha widget-alpha--color-green-jungle">
		@endif
			<div>
				<div class="widget-alpha__amount">{{$kecamatan}} Orang</div>
				<div class="widget-alpha__description">Kordinator Kecamatan</div>
			</div>
			<span class="widget-alpha__icon ua-icon-widget-user"></span>
		</div>
	</div>
	<div class="col-xl-3 col-lg-3 col-md-6">
		<div class="widget widget-alpha widget-alpha--color-orange widget-alpha--donut js-link" data-link="{{url('kordinator/kelurahan')}}">
			<div>
				<div class="widget-alpha__amount">{{$kelurahan}} Orang</div>
				<div class="widget-alpha__description">Kordinator Kelurahan</div>
			</div>
			<span class="widget-alpha__icon ua-icon-widget-user"></span>
		</div>
	</div>
	<div class="col-xl-3 col-lg-3 col-md-6">
		<div class="widget widget-alpha widget-alpha--color-java widget-alpha--help js-link" data-link="{{url('relawan/data')}}">
			<div>
				<div class="widget-alpha__amount">{{$relawan}} Orang</div>
				<div class="widget-alpha__description">Calon Pemilih</div>
			</div>
			<span class="widget-alpha__icon ua-icon-widget-user"></span>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6 col-12">
		<div class="statistic-widget statistic-widget-c">
			<div class="statistic-widget-c__heading">Daftar Pemilih</div>
			<div class="statistic-widget-c__body">
				<div class="statistic-widget-c__value">{{$pemilih}}</div>
				<div class="statistic-widget-c__title">Total Daftar Pemilih Tetap</div>
				<a href="#" class="statistic-widget-c__link">Lihat lebih banyak</a>
			</div>
		</div>
	</div>
	<div class="col-md-3 col-12">
		<div class="statistic-widget statistic-widget-c statistic-widget-c--heliotrope">
			<div class="statistic-widget-c__heading">Saksi</div>
			<div class="statistic-widget-c__body">
				<div class="statistic-widget-c__value">{{$saksi}}</div>
				<div class="statistic-widget-c__title">Keseluruhan Saksi TPS</div>
				<a href="{{url('relawan/data/saksi')}}" class="statistic-widget-c__link">Lihat lebih detail</a>
			</div>
		</div>	
	</div>
	<div class="col-md-3 col-12">
		<div class="statistic-widget statistic-widget-c statistic-widget-c--heliotrope">
			<div class="statistic-widget-c__heading">Caleg</div>
			<div class="statistic-widget-c__body">
				<div class="statistic-widget-c__value">{{$caleg}}</div>
				<div class="statistic-widget-c__title">Total Caleg</div>
				<a href="#" class="statistic-widget-c__link">Lihat lebih detail</a>
			</div>
		</div>	
	</div>
</div>
<div class="row">
	<div class="col-md-4 col-12">
		<div class="statistic-widget statistic-widget-c" style="height: 450px">
			<div class="statistic-widget-c__heading">Top 5 Calon Pemilih di Kelurahan</div>
			<div class="statistic-widget-c__body">
				<canvas id="relawanCountry"></canvas>
			</div>
		</div>
	</div>
	<div class="col-md-4 col-12">
		<div class="widget widget-controls widget-contacts widget-controls--dark" style="height: 450px">
			<div class="widget-controls__header">
				<div>
					<span class="widget-controls__header-icon ua-icon-user-solid"></span> Top 10 User Aktif
				</div>
			</div>
			<div class="widget-controls__content js-scrollable" data-simplebar="init"><div class="simplebar-track vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="top: 2px; height: 227px;"></div></div><div class="simplebar-track horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar"></div></div><div class="simplebar-scroll-content" style="padding-right: 15px; margin-bottom: -30px;"><div class="simplebar-content" style="padding-bottom: 15px; margin-right: -15px;">
			<div class="widget-controls__content-wrap">
				<div class="widget-contacts__item">
					<img src="img/users/user-4.png" alt="" width="40" height="40" class="widget-contacts__item-avatar rounded-circle">
					<div>
						<a href="#" class="widget-contacts__item-name">Gabriel Saunders</a>
						<div class="widget-contacts__item-email">gabriel@example.com</div>
					</div>
				</div>
				<div class="widget-contacts__item">
					<img src="img/users/user-5.png" alt="" width="40" height="40" class="widget-contacts__item-avatar rounded-circle">
					<div>
						<a href="#" class="widget-contacts__item-name">Shawna Cohen</a>
						<div class="widget-contacts__item-email">shawna@example.com</div>
					</div>
				</div>
				<div class="widget-contacts__item">
					<img src="img/users/user-6.png" alt="" width="40" height="40" class="widget-contacts__item-avatar rounded-circle">
					<div>
						<a href="#" class="widget-contacts__item-name">Jason Kendall</a>
						<div class="widget-contacts__item-email">jason@example.com</div>
					</div>
				</div>
				<div class="widget-contacts__item">
					<img src="img/users/user-7.png" alt="" width="40" height="40" class="widget-contacts__item-avatar rounded-circle">
					<div>
						<a href="#" class="widget-contacts__item-name">Thomas Banks</a>
						<div class="widget-contacts__item-email">thomas@example.com</div>
					</div>
				</div>
				<div class="widget-contacts__item">
					<img src="img/users/user-8.png" alt="" width="40" height="40" class="widget-contacts__item-avatar rounded-circle">
					<div>
						<a href="#" class="widget-contacts__item-name">Rebecca Harris</a>
						<div class="widget-contacts__item-email">rebecca@example.com</div>
					</div>
				</div>
				<div class="widget-contacts__item">
					<img src="img/users/user-6.png" alt="" width="40" height="40" class="widget-contacts__item-avatar rounded-circle">
					<div>
						<a href="#" class="widget-contacts__item-name">Jason Kendall</a>
						<div class="widget-contacts__item-email">jason@example.com</div>
					</div>
				</div>
				<div class="widget-contacts__item">
					<img src="img/users/user-7.png" alt="" width="40" height="40" class="widget-contacts__item-avatar rounded-circle">
					<div>
						<a href="#" class="widget-contacts__item-name">Thomas Banks</a>
						<div class="widget-contacts__item-email">thomas@example.com</div>
					</div>
				</div>
				<div class="widget-contacts__item">
					<img src="img/users/user-8.png" alt="" width="40" height="40" class="widget-contacts__item-avatar rounded-circle">
					<div>
						<a href="#" class="widget-contacts__item-name">Rebecca Harris</a>
						<div class="widget-contacts__item-email">rebecca@example.com</div>
					</div>
				</div>
			</div>
		</div></div></div>
		<div class="widget-controls__footer">
			<a href="#" class="widget-controls__footer-view-all">
				<span class="widget-controls__footer-view-all-icon iconfont-arrow-circle-right"></span><span>View more</span>
			</a>
		</div>
		</div>
	</div>
	<div class="col-md-4 col-12">
		<div class="statistic-widget statistic-widget-c" style="height: 450px">
			<div class="statistic-widget-c__heading">Statistik Calon Pemilih dalam 6 Bulan</div>
			<div class="statistic-widget-c__body">
				<div class="statistic-widget-c__value">{{$pemilih}}</div>
				<div class="statistic-widget-c__title">Calon Pemilih</div>
				<a href="#" class="statistic-widget-c__link">Lihat lebih banyak</a>
			</div>
		</div>
	</div>
</div>
<div class="row my-3">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<div class="statistic-widget-c__heading">Statistik Caleg</div>
				<div class="chart" style="width: 100%; height: 300px">
					<canvas id="myChart"></canvas>
				</div>
			</div>
		</div>
	</div>
</div>
<div style="display: none;" class="dname"></div>
@endsection
@section('footer')
<script type="text/javascript">
$(document).ready(function() {
	$('#card-box,#card-chart').collapse('show');
	$('#card-box').on('shown.bs.collapse', function () {
		$('.btn-toggle').html('hide');
	})
	$('#card-box').on('hidden.bs.collapse', function () {
		$('.btn-toggle').html('show');
	})

	$('#card-chart').on('shown.bs.collapse', function () {
		$('.btn-toggle-chart').html('hide');
	})
	$('#card-chart').on('hidden.bs.collapse', function () {
		$('.btn-toggle-chart').html('show');
	})
});
function datareturn() {
	return getKandidat();
}
var getKandidat = function(){
	var config;
	$.ajax({
	    url: '{{url('chart-kandidat')}}', // point to server-side PHP script 
	    cache: false,
	    dataType: 'json',
	    contentType: false,
	    processData: false,
	    type: 'get',
	    async: false,
	    success: function(data){
	    	config = data;
	    },
	    error: function(e) {
	    	console.log(e);
		}
	});
	return config;
}();
var RC = document.getElementById("relawanCountry");
RC.height = 180;
var myChart = new Chart(RC, {
    type: 'bar',
    data: {
        labels: {!! App\Helper\Lib::array2string($t_relawan['name'], true) !!},
        datasets: [{
            label: '#Jumlah Kordinator',
            data: {!! App\Helper\Lib::array2string($t_relawan['value']) !!},
            backgroundColor: {!! App\Helper\Lib::color(6) !!},
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            xAxes: [{
                ticks: {
                    display: false	
                }
            }],
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        },
        maintainAspectRatio: false,
    }
});

var ctx = document.getElementById("myChart");
	
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: getKandidat.name,
        datasets: [{
            label: '# of Votes',
            data: getKandidat.suara,
            backgroundColor: {!! App\Helper\Lib::color(10) !!},
            borderColor: {!! App\Helper\Lib::color(10) !!},
            borderWidth: 1
        }]
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
    }
});
</script>
@endsection