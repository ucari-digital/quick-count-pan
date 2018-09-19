@extends('component.dashboard_layout')
@section('title')
Activity
@endsection
@section('breadcrumb')
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
		<div class="main-container main-container--empty container-fh__content">
			<div class="container-header">
				<h2 class="container-heading">Activity</h2>
			</div>
			<div class="container-body">
				<div class="tab-content">
					<div class="tab-pane active show" id="activity-stream">
						<div class="p-activity__items">
							<h3 class="p-activity__heading">Recent Activity</h3>
							@foreach($data as $item)
							<div class="p-activity__item">
								<div class="p-activity__item-wrap">
									<span class="p-activity__item-figure p-activity__item-figure--scooter">
										<span class="ua-icon-arrow-up p-activity__item-icon p-activity__item-icon--lg"></span>
									</span>
									<div class="p-activity__item-info">
										<a href="#" class="p-activity__item-user">
											<img src="{{url(''.App\Model\Anggota::detail($item->anggota_id)->foto)}}" width="22" height="22" alt="" class="p-activity__item-user-avatar rounded-circle">
											<span>{{App\Model\Anggota::detail($item->anggota_id)->name}}</span>
										</a> 
										{!! $item->message !!}
										<span class="text-muted-md">{{Carbon\Carbon::now()->diffForHumans($item->created_at)}}</span>
										<div class="p-activity__item-image">
											<img src="{{url($item->image)}}" alt="" style="width: 60%">
										</div>
									</div>
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection