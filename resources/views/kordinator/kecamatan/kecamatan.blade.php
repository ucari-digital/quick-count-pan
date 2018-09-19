@extends('component.dashboard_layout')
@section('breadcrumb')
<div class="page-content__header">
	<div>
		<h2 class="page-content__header-heading">Kordinator Kecamatan</h2>
	</div>
	@if($auth->posisi == 'kecamatan' || $auth->posisi == 'superadmin')
	<div class="page-content__header-meta">
		<a href="{{url('kordinator/kecamatan/create')}}" class="btn btn-info icon-left">
			Tambah
		</a>
	</div>
	@endif
</div>
@endsection
@section('content')
<div class="row mt-5">
	<div class="col-md-12 mb-3">
		<div class="order-collapse gray">
			<a class="order-collapse__header" data-toggle="collapse" href="#collapse3" aria-expanded="false" aria-controls="collapse3">
				<h4>Detail Pencarian</h4>
				<span>
					<span class="collapse-icon ua-icon-arrow-down-alt"></span>
				</span>
			</a>
			<div class="collapse show order-collapse-inner" id="collapse3">
				<form action="{{url('kordinator/kecamatan/search')}}" method="post" class="p-3">
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
		<div class="m-datatable">
			<table class="table dtable-r">
				<thead>
					<tr>
						<th></th>
						<th>Nomor KTP</th>
						<th>Nama Lengkap</th>
						<th>Pengikut</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data as $item)
					<tr>
						<td></td>
						<td>{{$item->no_ktp}}</td>
						<td>{{$item->name}}</td>
						<td>{{$item->downline}} Pengikut</td>
						<td>
							<div class="btn-group">
								<button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Aksi
								</button>
								<div class="dropdown-menu">
									<a class="dropdown-item" href="{{url('kordinator/dl/'.$item->anggota_id)}}">Lihat Anggota</a>
									{{-- <a class="dropdown-item" href="{{url('kordinator/p/'.$item->anggota_id)}}">Lihat Profil</a> --}}
									<a class="dropdown-item" href="{{url('kordinator/'.$item->posisi.'/edit/'.$item->anggota_id)}}">Edit</a>
									@if($item->downline == 0)
									<a class="dropdown-item" href="{{url('hapus/u/'.$item->anggota_id)}}">Hapus</a>
									@endif
								</div>
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection
@section('footer')
	<script type="text/javascript">
		$('#collapse3').collapse('hide');
	</script>
@endsection