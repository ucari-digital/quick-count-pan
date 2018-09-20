@extends('component.dashboard_layout')
@section('breadcrumb')
<div class="page-content__header">
	<div>
		<h2 class="page-content__header-heading">Penambahan Kordinator Kelurahan</h2>
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
				<form action="{{url('kordinator/kelurahan/create/submit')}}" method="post" enctype="multipart/form-data">
					@csrf
					<div class="row">
						<div class="col-md-5">
							<div class="form-group">
								<label>No KTP</label>
								<input type="text" name="no_ktp" class="form-control" placeholder="No KTP" />
							</div>
						</div>
						<div class="col-md-5">
							<div class="form-group">
								<label>Nama (Sesuai KTP)</label>
								<input type="text" name="name" class="form-control" placeholder="Nama Lengkap" onchange="GUID(this.value)" />
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>Jenis Kelamin</label>
								<select name="jk" class="form-control">
									<option value="L">L</option>
									<option value="P">P</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>Tempat, Tgl lahir</label>
								<div class="input-group">
									<input type="text" name="tempat" class="form-control" placeholder="Tempat lahir">
									<input type="text" name="tgl_lahir" class="form-control" id="date-mask" placeholder="Tgl lahir">
								</div>
							</div>
						</div>
						<div class="col-md-5">
							<div class="form-group">
								<label>Alamat rumah sekarang</label>
								<input type="text" name="alamat" class="form-control" placeholder="Alamat rumah" />
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label>RT/RW</label>
								<input type="text" name="rtrw" class="form-control" placeholder="RT/RW">
							</div>
						</div>
						<div class="col-md-1">
							<div class="form-group">
								<label>TPS</label>
								<input type="text" name="tps" class="form-control" placeholder="TPS">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label>Provinsi</label>
								<select name="provinsi" class="form-control provinsi" required="">
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
								<select name="kabkota" class="form-control kabkota" required="">
									<option value="">PILIH</option>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Kecamatan</label>
								<select name="kecamatan" class="form-control kecamatan" required="">
									<option value="">PILIH</option>
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Kelurahan</label>
								<select name="kelurahan" class="form-control kelurahan" required="">
									<option value="">PILIH</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Agama</label>
								<select name="agama" class="form-control">
									<option value="islam">Islam</option>
									<option value="kristen protestan">Kristen Protestan</option>
									<option value="katolik">Katolik</option>
									<option value="hindu">Hindu</option>
									<option value="buddha">Buddha</option>
									<option value="kong hu cu">Kong Hu Cu</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Pekerjaan</label>
								<select name="pekerjaan" class="form-control">
									<option value="">PILIH</option>
									<option value="Pegawai Negri Sipil">Pegawai Negri Sipil (PNS)</option>
									<option value="Karyawan BUMN">Karyawan BUMN</option>
									<option value="Karyawan Swasta">Karyawan Swasta</option>
									<option value="Pengusaha">Pengusaha</option>
									<option value="Pelajar / Mahasiswa">Pelajar / Mahasiswa</option>
									<option value="Mengurus Rumah Tangga">Mengurus Rumah Tangga</option>
									<option value="Honorer">Honorer</option>
									<option value="Buruh">Buruh</option>
									<option value="Wartawan">Wartawan</option>
									<option value="Nelayan">Nelayan</option>
									<option value="Petani">Petani</option>
									<option value="Tentara">Tentara</option>
									<option value="Kepolisian">Kepolisian</option>
									<option value="Pensiunan">Pensiunan</option>
									<option value="Tidak / Belum Bekerja">Tidak / Belum Bekerja</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label>No HP</label>
								<input type="text" name="no_hp" class="form-control" placeholder="No HP">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>No WhatsApp</label>
								<input type="text" name="no_wa" class="form-control" placeholder="No WhatsApp">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Email</label>
								<input type="Email" name="email" class="form-control" placeholder="No Email">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label>User ID</label>
								<input type="text" name="anggota_id" class="form-control" placeholder="User ID">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Password</label>
								<input type="password" name="password" class="form-control" placeholder="Password">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Foto</label>
								<input type="file" name="foto" class="form-control" placeholder="Foto">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label>Foto KTP</label>
								<input type="file" name="foto_ktp" class="form-control" placeholder="Foto">
							</div>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-12">
							<button class="btn btn-gradient-primary">Simpan</button>
							<button class="btn btn-gradient-secondary">Batal</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@section('footer')
<script type="text/javascript">
	function GUID(value) {
		$("input[name=anggota_id]").val($('input[name=no_ktp]').val());
	}
</script>
@endsection