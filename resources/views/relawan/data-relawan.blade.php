@extends('component.dashboard_layout')
@php
$auth = App\Helper\Lib::auth();
@endphp
@section('breadcrumb')
<div class="page-content__header">
	<div>
		<h2 class="page-content__header-heading">Relawan</h2>
	</div>
	@if($auth->posisi == 'kelurahan' || $auth->posisi == 'rtrw')
	<div class="page-content__header-meta">
		<a href="{{url('relawan/create')}}" class="btn btn-info icon-left">
			Tambah
		</a>
	</div>
	@endif
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
	<div class="col-md-12 mb-3">
		<div class="order-collapse gray">
			<a class="order-collapse__header" data-toggle="collapse" href="#collapse3" aria-expanded="false" aria-controls="collapse3">
				<h4>Detail Pencarian</h4>
				<span>
					<span class="collapse-icon ua-icon-arrow-down-alt"></span>
				</span>
			</a>
			<div class="collapse show order-collapse-inner" id="collapse3">
				<form action="{{url('relawan/search')}}" method="post" class="p-3">
					@csrf
					<div class="row">
						<div class="col-md-5">
							<div class="form-group">
								<label>Nama</label>
								<input name="nama" type="text" class="form-control" placeholder="Nama Lengkap">
							</div>
						</div>
						<div class="col-md-5">
							<div class="form-group">
								<label>Email</label>
								<input name="email" type="text" class="form-control" placeholder="Email">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>Jenis Kelamin</label>
								<select name="jk" class="form-control">
									<option value="">PILIH</option>
									<option value="L">Laki - Laki</option>
									<option value="P">Perempuan</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label>Provinsi</label>
								<select name="provinsi" class="form-control provinsi">
									<option value="">PILIH</option>
									@foreach($provinsi as $item)
									<option value="{{$item->id}}">{{$item->name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Kabupaten / Kota</label>
								<select name="kabkota" class="form-control kabkota">
									<option value="">PILIH</option>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Kecamatan</label>
								<select name="kecamatan" class="form-control kecamatan">
									<option value="">PILIH</option>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Kelurahan</label>
								<select name="kelurahan" class="form-control kelurahan">
									<option value="">PILIH</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label>RT</label>
								<input name="rt" type="text" class="form-control" placeholder="RT">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>RW</label>
								<input name="rw" type="text" class="form-control" placeholder="RW">
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>Role</label>
								<select name="role" class="form-control">
									<option value="">PILIH</option>
									<option value="saksi">Saksi</option>
									<option value="relawan">Relawan</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row justify-content-end">
						<div class="col-md-2">
							<button class="btn btn-primary btn-block">Mencari</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="m-datatable table-responsive">
			<table class="table table-striped dtable-r" style="width: 1200px">
			<thead>
				<tr>
					<th>No. KK</th>
					<th>No. KTP</th>
					<th>Nama</th>
					<th>Jenis Kelamin</th>
					<th>Tgl. Lahir</th>
					<th>Kecamatan</th>
					<th>Kelurahan</th>
					<th>Sebagai Saksi</th>
					@if($auth->role != 'relawan')
					<th>Aksi</th>
					@endif
				</tr>
			</thead>
			<tbody>
				@foreach($data as $item)
				<tr>
					<td>{{$item->no_kartu_keluarga}}</td>
					<td>{{$item->no_ktp}}</td>
					<td>{{$item->name}}</td>
					@if($item->jk == 'L')
					<td style="width: 120px">Laki - Laki</td>
					@else
					<td style="width: 120px">Perempuan</td>
					@endif
					<td>{{App\Helper\TimeFormat::id(explode(',', $item->ttl)[1])}}</td>
					<td>{{App\Model\Kecamatan::getName($item->kecamatan)->name}}</td>
					<td>{{App\Model\Kelurahan::getName($item->kelurahan)->name}}</td>
					@if($item->posisi == 'saksi')
					<td style="width: 130px">Ya</td>
					@else
					<td style="width: 130px">Tidak</td>
					@endif
					@if($auth->role != 'relawan')
					<td>
						<div class="btn-group">
							<button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Aksi
							</button>
							<div class="dropdown-menu">
								@if($auth->role == 'superadmin')
									@if($item->posisi == 'relawan_ring2')
									<a class="dropdown-item" href="{{url('/dl/pemilih/'.$item->anggota_id)}}">Lihat Anggota</a>
									@else
									<a class="dropdown-item" href="{{url('/dl/'.$item->role.'/'.$item->anggota_id)}}">Lihat Anggota</a>
									@endif
								@endif
								{{-- <a class="dropdown-item" href="{{url('kordinator/p/'.$item->anggota_id)}}">Lihat Profil</a> --}}
								<a class="dropdown-item" href="{{url('relawan/edit/'.$item->anggota_id)}}">Edit</a>

								@if($item->posisi == 'saksi')
								<a class="dropdown-item" href="{{url('saksi/delete/'.$item->anggota_id)}}">Tidak Jadikan Saksi</a>
								@else
								<a class="dropdown-item" href="#" onclick="modl('{{$item->anggota_id}}', '{{$item->name}}')">Jadikan Saksi</a>
								@endif
								
								@if($item->downline == 0)
								<a class="dropdown-item" href="{{url('hapus/u/'.$item->anggota_id)}}">Hapus</a>
								@endif
							</div>
						</div>
					</td>
					@endif
				</tr>
				@endforeach
			</tbody>
			</table>
		</div>
	</div>
</div>

{{-- MODAL SAKSI --}}
<div class="modal fade" id="saksi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Form Saksi</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{url('saksi/create')}}" method="post" class="form">
					@csrf
					<input type="hidden" name="anggota_id">
					<div class="form-group">
						<label>Nama</label>
						<input type="text" name="name" class="form-control" readonly="">
					</div>
					<div class="form-group">
						<label>Kabupaten / Kota</label>
						<select name="kabkota" class="form-control kabkota">
							<option>PILIH</option>
							@foreach($kota as $item)
							<option value="{{$item->id}}">{{$item->name}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label>Kecamatan</label>
						<select name="kecamatan" class="form-control kecamatan">
							
						</select>
					</div>
					<div class="form-group">
						<label>Kelurahan</label>
						<select name="kelurahan" class="form-control kelurahan">
							
						</select>
					</div>
					<div class="form-group">
						<label>TPS</label>
						<input type="text" name="tps" class="form-control" placeholder="TPS" />
					</div>

				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary submit">Save changes</button>
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
	$('#collapse3').collapse('hide');
	function modl(anggota_id, name) {
		$('input[name="name"]').val(name);
		$('input[name="anggota_id"]').val(anggota_id);
		$('#saksi').modal({
  			keyboard: false,
  			show: true
		})
	}
	$('.provinsi').change(function(){
		$('.kabkota').html('');
		$('.kabkota').append($("<option></option>").attr("value", "").text('PILIH'));
		$.get('{{url('kota')}}/'+$(this).val(), function(data){
			$.each(data, function(key, value) {  
				console.log(value);
				$('.kabkota')
				.append($("<option></option>")
			        .attr("value",value.id)
			        .text(value.name)); 
			});
		});
	});
	$('.kabkota').change(function(){
		$('.kecamatan').html('');
		$('.kecamatan').append($("<option></option>").attr("value", "").text('PILIH'));
		$.get('{{url('kecamatan')}}/'+$(this).val(), function(data){
			$.each(data, function(key, value) {  
				$('.kecamatan')
				.append($("<option></option>")
			        .attr("value",value.id)
			        .text(value.name)); 
			});
		});
	});
	$('.kecamatan').change(function(){
		$('.kelurahan').html('');
		$('.kelurahan').append($("<option></option>").attr("value", "").text('PILIH'));
		$.get('{{url('kelurahan')}}/'+$(this).val(), function(data){
			$.each(data, function(key, value) {  
				$('.kelurahan')
				.append($("<option></option>")
			        .attr("value",value.id)
			        .text(value.name)); 
			});
		});
	});
</script>
@endsection