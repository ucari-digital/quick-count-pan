@extends('component.dashboard_layout')
@php
$auth = App\Helper\Lib::auth();
@endphp
@section('breadcrumb')
<div class="page-content__header">
	<div>
		<h2 class="page-content__header-heading">Input Hasil Pemilihan</h2>
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
				<form action="{{url('event/pendataan/input/event/submit')}}" method="post" enctype="multipart/form-data">
					@csrf
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Jumlah DPT</label>
						<div class="col-sm-6">
							<input type="text" name="total_dpt" class="form-control" placeholder="Jumlah DPT" value="{{$anggota_quick_count['total_dpt']}}" required="">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Jumlah Suara</label>
						<div class="col-sm-6">
							<input type="text" name="jumlah_suara" class="form-control" placeholder="Jumlah Suara" required="">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Pilih Suara</label>
						<div class="col-sm-6">
							<select name="kandidat_id" class="form-control" required="">
								<option>PILIH</option>
								@foreach($kandidat as $item)
								<option value="{{$item->id}}">{{$item->name}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Suara Tidak Sah</label>
						<div class="col-sm-6">
							<input type="text" name="jumlah_suara_tidak_sah" class="form-control" placeholder="Suara tidak sah" value="{{$anggota_quick_count['jumlah_suara_tidak_sah']}}" required="">
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Bukti Form C1</label>
						<div class="col-sm-6">
							<input type="file" name="bukti" class="form-control" required="">
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-8">
							<button type="submit" class="btn btn-primary float-right">Simpan</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection