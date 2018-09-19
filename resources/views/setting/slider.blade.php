@extends('component.dashboard_layout')
@section('breadcrumb')
<div class="page-content__header">
	<div>
		<h2 class="page-content__header-heading">Slider</h2>
	</div>
	<div class="page-content__header-meta">
		<div class="btn btn-info icon-left upload_btn">
			Upload
		</div>
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
		<form action="{{url('setting/slider/create')}}" method="post" enctype="multipart/form-data" style="display: none;" class="submit">
			@csrf
			<input type="hidden" name="referred_by" value="{{App\Helper\Lib::auth()->anggota_id}}">
			<input type="hidden" name="posisi" value="{{App\Helper\Lib::auth()->posisi}}">
			<div class="row">
				<div class="col-md-5">
					<div class="form-group">
						<label>Image Slider</label>
						<input type="file" name="slider" class="form-control" id="f_upload" />
					</div>
				</div>
			</div>					
		</form>

		<div class="row">
			@foreach($data as $item)
			<div class="col-md-4">
				<div class="statistic-widget statistic-widget-d" style="height: 200px">
					<div class="statistic-widget-d__body p-0">
						<img src="{{url($item->image)}}" style="width: 100%;">
					</div>
					<a href="{{url('setting/slider/delete/'.$item->id)}}" class="statistic-widget-d__link">Hapus</a>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>
@endsection
@section('footer')
<script type="text/javascript">
	$(".upload_btn").unbind("click").bind("click", function () {
   		$("#f_upload").click();
	});
	$('#f_upload').on('change', function(){
		$('.submit').submit();
	});
</script>
@endsection