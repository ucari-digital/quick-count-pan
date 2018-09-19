@extends('component.dashboard_layout')
@section('title')
Calon Pemilih
@endsection
@section('breadcrumb')
<div class="page-content__header">
	<div>
		<h2 class="page-content__header-heading">Calon Pemilih</h2>
	</div>
</div>
@endsection
@section('content')
<div class="row justify-content-md-center">
	<div class="col-md-3">
		<div class="widget widget-alpha widget-alpha--color-amaranth">
			<div>
				<div class="widget-alpha__amount">{{$total_relawan_l}}</div>
				<div class="widget-alpha__description">Laki-Laki</div>
			</div>
			<span class="widget-alpha__icon ua-icon-widget-user"></span>
		</div>
	</div>
	<div class="col-md-3">
		<div class="widget widget-alpha widget-alpha--color-green-jungle">
			<div>
				<div class="widget-alpha__amount">{{$total_relawan_p}}</div>
				<div class="widget-alpha__description">Perempuan</div>
			</div>
			<span class="widget-alpha__icon ua-icon-widget-user"></span>
		</div>
	</div>
	<div class="col-md-3">
		<div class="widget widget-alpha widget-alpha--color-orange">
			<div>
				<div class="widget-alpha__amount">{{$total_relawan}} / {{$target['relawan']}}</div>
				<div class="widget-alpha__description">Target Calon Pemilih</div>
			</div>
			<span class="widget-alpha__icon ua-icon-widget-user"></span>
		</div>
	</div>
	<div class="col-md-3">
		<div class="widget widget-alpha widget-alpha--color-java">
			<div>
				<div class="widget-alpha__amount">{{$total_relawan}}</div>
				<div class="widget-alpha__description">Jumlah Calon Pemilih</div>
			</div>
			<span class="widget-alpha__icon ua-icon-widget-user"></span>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-8">
		<div class="statistic-widget statistic-widget-c" style="height: 400px">
			<div class="statistic-widget-c__heading mb-0">
				<div class="row">
					<div class="col-md-6">
						Statistik Calon Pemilih
					</div>
					<div class="col-md-6">
						<ul class="nav nav-tabs float-right" id="myTab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="daily-tab" data-toggle="tab" href="#daily" role="tab" aria-controls="daily" aria-selected="true">Daily</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="weekly-tab" data-toggle="tab" href="#weekly" role="tab" aria-controls="weekly" aria-selected="false">Weekly</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="monthly-tab" data-toggle="tab" href="#monthly" role="tab" aria-controls="monthly" aria-selected="false">monthly</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="statistic-widget-c__body">
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="daily" role="tabpanel" aria-labelledby="daily-tab">
						<canvas id="c_day"></canvas>
					</div>
					<div class="tab-pane fade active" id="weekly" role="tabpanel" aria-labelledby="weekly-tab">
						<canvas id="c_week"></canvas>
					</div>
					<div class="tab-pane fade active" id="monthly" role="tabpanel" aria-labelledby="monthly-tab">
						<canvas id="c_month"></canvas>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="widget widget-controls widget-contacts widget-controls--dark" style="height: 400px">
			<div class="widget-controls__header">
				<div>
					<span class="widget-controls__header-icon ua-icon-user-solid"></span> 10 Calon Pemilih Terbaru
				</div>
			</div>
			<div class="widget-controls__content js-scrollable" data-simplebar="init"><div class="simplebar-track vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="top: 2px; height: 213px;"></div></div><div class="simplebar-track horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar"></div></div><div class="simplebar-scroll-content" style="padding-right: 17px; margin-bottom: -34px;"><div class="simplebar-content" style="padding-bottom: 17px; margin-right: -17px;">
			<div class="widget-controls__content-wrap">
				@foreach($new_relawan as $item)
				<div class="widget-contacts__item">
					<img src="{{''.$item->foto}}" alt="" width="40" height="40" class="widget-contacts__item-avatar rounded-circle">
					<div>
						<a href="#" class="widget-contacts__item-name">{{$item->name}}</a>
						<div class="widget-contacts__item-email">{{$item->email}}</div>
					</div>
				</div>
				@endforeach
			</div>
		</div></div></div>
		<div class="widget-controls__footer">
			<a href="{{url('relawan/data')}}" class="widget-controls__footer-view-all">
				<span class="widget-controls__footer-view-all-icon iconfont-arrow-circle-right"></span><span>Lihat Semua</span>
			</a>
		</div>
		</div>
	</div>
</div>
@endsection
@section('footer')
	<script type="text/javascript">
		$('#collapse3').collapse('hide');
	</script>
	<script>
	var ctx = document.getElementById("c_day");
	ctx.height = 300;
	var myChart = new Chart(ctx, {
	    type: 'line',
	    data: {
	        labels:  {!! App\Helper\Lib::array2string($days['time'], true) !!},
	        datasets: [{
	            label: '# of Votes',
	            data: {!! App\Helper\Lib::array2string($days['value']) !!},
	            backgroundColor: 'rgba(255, 99, 132, 0.2)',
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

	var ctx = document.getElementById("c_week");
	ctx.height = 300;
	var myChart = new Chart(ctx, {
	    type: 'line',
	    data: {
	        labels:  {!! App\Helper\Lib::array2string($week['time'], true) !!},
	        datasets: [{
	            label: '# of Votes',
	            data: {!! App\Helper\Lib::array2string($week['value']) !!},
	            backgroundColor: 'rgba(255, 99, 132, 0.2)',
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

	var ctx = document.getElementById("c_month");
	ctx.height = 300;
	var myChart = new Chart(ctx, {
	    type: 'line',
	    data: {
	        labels:  {!! App\Helper\Lib::array2string($month['time'], true) !!},
	        datasets: [{
	            label: '# of Votes',
	            data: {!! App\Helper\Lib::array2string($month['value']) !!},
	            backgroundColor: 'rgba(255, 99, 132, 0.2)',
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