@extends('component.dashboard_layout')
@php
$auth = App\Helper\Lib::auth();
@endphp
@section('breadcrumb')
<div class="page-content__header">
	<div>
		<h2 class="page-content__header-heading">Pendataan Pra Event</h2>
	</div>
	<div class="page-content__header-meta">
		<button class="btn btn-info icon-left" data-toggle="modal" data-target="#cariModal">
			Cari
		</button>
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
				<table class="table" id="dtable">
					<thead>
						<tr>
							<th>NIK</th>
							<th>Nama</th>
							<th>RT / RW</th>
							<th>Pilihan</th>
							<th>Unggah Bukti</th>
							<th>Bukti</th>
						</tr>
					</thead>
					<tbody>
						@foreach($data as $item)
						<tr>
							<td>{{$item->no_ktp}}</td>
							<td>{{$item->name}}</td>
							<td>{{$item->rtrw}}</td>
							<td>
								<select name="kandidat" class="form-control" onchange="kandidat('{{$item->no_ktp}}', '{{$item->group_id}}', this.value)">
									@if($item->kandidat_id)
									<option value="{{$item->kandidat_id}}">{{App\Model\Kandidat::find($item->kandidat_id)->name}}</option>
									@else
									<option>PILIH</option>
									@endif
									@foreach($kandidat as $items)
									<option value="{{$items->id}}">{{$items->name}}</option>
									@endforeach
								</select>
							</td>
							<td>
								<input type="file" name="bukti" class="form-control u{{$item->id}}" onchange="bukti('{{$item->no_ktp}}', '{{$item->group_id}}', 'u{{$item->id}}', this.value);">
							</td>
							<td>
								<img src="{{url(''.$item->bukti)}}" class="rounded" style="width: 40px;">
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

{{-- SEARCH --}}
<div class="modal fade" id="cariModal" tabindex="-1" role="dialog" aria-labelledby="cariModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="cariModalLabel">Modal title</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<input type="text" name="nik" class="form-control" placeholder="NIK">
				</div>
				<table class="table">
					<tr>
						<td>Nik</td>
						<td id="tnik"></td>
					</tr>
					<tr>
						<td>Nama</td>
						<td id="tname"></td>
					</tr>
					<tr>
						<td>RT / RW</td>
						<td id="trtrw"></td>
					</tr>
				</table>
				<form action="{{url('event/pendataan/input/pra-event/submit')}}" method="post" enctype="multipart/form-data" class="mt-3 form">
					@csrf
					<input type="hidden" name="no_ktp">
					<input type="hidden" name="group_id">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<select name="kandidat" class="form-control">
									@foreach($kandidat as $item)
									<option value="{{$item->id}}">{{$item->name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<input type="file" name="bukti" class="form-control">
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
				<button type="submit" class="btn btn-primary submit">Simpan</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    	<div class="modal-body">
    		Berhasil diubah
    	</div>
    </div>
  </div>
</div>
@endsection
@section('footer')
<script type="text/javascript">
	$('.submit').click(function(){
		$('.form').submit();
	});
	$('input[name="nik"]').on('keyup', function(){
		$.get('{{url('pencarian-anggota')}}', 
			{
				nik: $(this).val()
			},
		function(data){
			$('input[name="no_ktp"]').val(data.no_ktp);
			$('input[name="group_id"]').val(data.group_id);
			$('#tnik').html(data.no_ktp);
			$('#tname').html(data.name);
			$('#trtrw').html(data.rtrw);
		});
	})
	function kandidat(no_ktp, group_id, kandidat_id) {
		$.post('{{url('event/pendataan/input/pra-event/submit')}}', 
			{
				no_ktp: no_ktp,
				group_id: group_id,
				kandidat: kandidat_id,
				r_type: 'json',
				_token: $('input[name="_token"]').val()
			},
		function(data){
			console.log(data);
			$('.bd-example-modal-sm').modal();
			$('.bd-example-modal-sm').on('shown.bs.modal', function (e) {
				$('.bd-example-modal-sm').modal('hide')
			})
		});
	}
</script>
<script type="text/javascript">
	function bukti(no_ktp, group_id, id, ini) {
		var file_data = $('.'+id).prop('files')[0];   
	    var form_data = new FormData();                  
	    form_data.append('bukti', file_data);
	    form_data.append('no_ktp', no_ktp);
	    form_data.append('group_id', group_id);
	    form_data.append('_token', $('input[name="_token"]').val());
	    form_data.append('r_type', 'json');
	    $.ajax({
	        url: '{{url('event/pendataan/input/pra-event/submit')}}', // point to server-side PHP script 
	        cache: false,
	        dataType: 'json',
	        contentType: false,
	        processData: false,
	        data: form_data,                     
	        type: 'post',
	        success: function(response){
	        	console.log(response);
	            $('.bd-example-modal-sm').modal();
				$('.bd-example-modal-sm').on('shown.bs.modal', function (e) {
					$('.bd-example-modal-sm').modal('hide')
				})
	        },
	        error: function(e) {
	        	console.log(e);
       			$('.bd-example-modal-sm').modal();
				$('.bd-example-modal-sm').on('shown.bs.modal', function (e) {
					$('.bd-example-modal-sm').modal('hide')
				})
    		}
     	});

	}
</script>
@endsection