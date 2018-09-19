<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Purple Admin</title>
		<!-- plugins:css -->
		<link rel="stylesheet" href="{{url('fonts/open-sans/style.min.css')}}"> <!-- common font  styles  -->
        <link rel="stylesheet" href="{{url('fonts/universe-admin/style.css')}}"> <!-- universeadmin icon font styles -->
        <link rel="stylesheet" href="{{url('fonts/mdi/css/materialdesignicons.min.css')}}"> <!-- meterialdesignicons -->
        <link rel="stylesheet" href="{{url('fonts/iconfont/style.css')}}"> <!-- DEPRECATED iconmonstr -->
        <link rel="stylesheet" href="{{url('vendor/flatpickr/flatpickr.min.css')}}"> <!-- original flatpickr plugin (datepicker) styles -->
        <link rel="stylesheet" href="{{url('vendor/simplebar/simplebar.css')}}"> <!-- original simplebar plugin (scrollbar) styles  -->
        <link rel="stylesheet" href="{{url('vendor/tagify/tagify.css')}}"> <!-- styles for tags -->
        <link rel="stylesheet" href="{{url('vendor/tippyjs/tippy.css')}}"> <!-- original tippy plugin (tooltip) styles -->
        <link rel="stylesheet" href="{{url('vendor/select2/css/select2.min.css')}}"> <!-- original select2 plugin styles -->
        <link rel="stylesheet" href="{{url('vendor/bootstrap/css/bootstrap.min.css')}}"> <!-- original bootstrap styles -->
        <link rel="stylesheet" href="{{url('css/style.min.css')}}" id="stylesheet"> <!-- universeadmin styles -->
        <link rel="stylesheet" href="{{url('vendor/datatables/datatables.min.css')}}" id="stylesheet">
	</head>
	<body class="container">
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
				<div class="k_provinsi"></div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label>Kabupaten / Kota</label>
					<select name="kabkota" class="form-control kabkota" required="">
						<option value="">PILIH</option>
					</select>
				</div>
				<div class="k_kota"></div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label>Kecamatan</label>
					<select name="kecamatan" class="form-control kecamatan" required="">
						<option value="">PILIH</option>
					</select>
				</div>
				<div class="k_kecamatan"></div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label>Kelurahan</label>
					<select name="kelurahan" class="form-control kelurahan" required="">
						<option value="">PILIH</option>
					</select>
					<div class="k_kelurahan"></div>
				</div>
			</div>
		</div>
		<!-- container-scroller -->
		<!-- plugins:js -->
		<script src="{{url('vendor/echarts/echarts.min.js')}}"></script>
	    <script src="{{url('vendor/jquery/jquery.min.js')}}"></script>
	    <script src="{{url('vendor/popper/popper.min.js')}}"></script>
	    <script src="{{url('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
	    <script src="{{url('vendor/select2/js/select2.full.min.js')}}"></script>
	    <script src="{{url('vendor/simplebar/simplebar.js')}}"></script>
	    <script src="{{url('vendor/text-avatar/jquery.textavatar.js')}}"></script>
	    <script src="{{url('vendor/tippyjs/tippy.all.min.js')}}"></script>
	    <script src="{{url('vendor/flatpickr/flatpickr.min.js')}}"></script>
	    <script src="{{url('vendor/wnumb/wNumb.js')}}"></script>
	    <script src="{{url('js/main.js')}}"></script>
	    <script src="{{url('vendor/sparkline/jquery.sparkline.min.js')}}"></script>
	    <script src="{{url('vendor/datatables/datatables.min.js')}}"></script>
	    <script src="{{url('js/preview/datatables.js')}}"></script>
	    <script src="{{url('js/preview/sales-dashboard.min.js')}}"></script>
		<!-- endinject -->
		<script type="text/javascript">
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
				$('.k_provinsi').html('Kode : '+this.value);
			});
			$('.kabkota').change(function(){
				$('.kecamatan').html('');
				$('.kecamatan').append($("<option></option>").attr("value", "").text('PILIH'));
				$.get('{{url('kecamatan')}}/'+$(this).val(), function(data){
					$.each(data, function(key, value) {
						console.log(value);
						$('.kecamatan')
						.append($("<option></option>")
					.attr("value",value.id)
					.text(value.name));
					});
				});
				$('.k_kota').html('Kode : '+this.value);
			});
			$('.kecamatan').change(function(){
				console.log('a');
				$('.kelurahan').html('');
				$('.kelurahan').append($("<option></option>").attr("value", "").text('PILIH'));
				$.get('{{url('kelurahan')}}/'+$(this).val(), function(data){
					$.each(data, function(key, value) {
						console.log(value);
						$('.kelurahan')
						.append($("<option></option>")
					.attr("value",value.id)
					.text(value.name));
					});
				});
				$('.k_kecamatan').html('Kode : '+this.value);
			});
			$('.kelurahan').change(function(){
				$('.k_kelurahan').html('Kode : '+this.value);
			});
		</script>
	</body>
</html>