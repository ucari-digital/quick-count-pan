@extends('component.dashboard_layout')
@section('title')
Aktivitas Distribusi APK
@endsection
@section('breadcrumb')
<div class="page-content__header">
	<div>
		<h2 class="page-content__header-heading">Aktivitas Distribusi APK</h2>
	</div>
	<div class="page-content__header-meta">
		<a href="{{url('activity/kegiatan/create')}}" class="btn btn-info icon-left">
			Upload
		</a>
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
		<div class="main-container main-container--empty container-fh__content">
			<div class="container-header">
				<h2 class="container-heading">Aktivitas Terbaru</h2>
			</div>
			<div class="container-body">
				<div class="tab-content">
					<div class="tab-pane active show" id="activity-stream">
						<div class="p-activity__items">
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
										@if(App\Helper\Lib::auth()->anggota_id == $item->anggota_id)
										<a href="{{url('activity/kegiatan/edit/'.$item->id)}}">Edit</a>
										@endif
										@php
										$image_not_filter = explode(',', $item->image);
										$image = array_values(array_filter($image_not_filter));
										@endphp
										<div class="p-activity__item-image">
											@foreach($image as $img)
												<img src="{{url($img)}}" alt="" style="width: 33.9999999%">
											@endforeach
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