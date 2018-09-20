@if($auth->posisi == 'pusat')
<ul class="sidebar-section-nav">
    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link" href="{{url('kordinator')}}">
            <span class="sidebar-section-nav__item-icon mdi mdi-home"></span>
            <span class="sidebar-section-nav__item-text">Halaman Utama</span>
        </a>
    </li>
    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link" href="{{url('relawan')}}">
            <span class="sidebar-section-nav__item-icon mdi mdi-account-check"></span>
            <span class="sidebar-section-nav__item-text">Calon Pemilih</span>
        </a>
    </li>
    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link sidebar-section-nav__link-dropdown" href="#">
            <span class="sidebar-section-nav__item-icon mdi mdi-account-star"></span>
            <span class="sidebar-section-nav__item-text">Koordinator</span>
        </a>
        <ul class="sidebar-section-subnav">
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('kordinator/all')}}">Semua Koordinator</a></li>
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('kordinator/kabkota')}}">Kota</a></li>
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('kordinator/kecamatan')}}">Kecamatan</a></li>
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('kordinator/kelurahan')}}">Kelurahan</a></li>
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('kordinator/rtrw')}}">RT / RW</a></li>
        </ul>
    </li>
    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link sidebar-section-nav__link-dropdown" href="#">
            <span class="sidebar-section-nav__item-icon mdi mdi-account-star"></span>
            <span class="sidebar-section-nav__item-text">Aktivitas</span>
        </a>
        <ul class="sidebar-section-subnav">
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('activity')}}">Distribusi APK</a></li>
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('activity')}}">History Pengguna</a></li>
        </ul>
    </li>
    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link" href="{{url('activity/kegiatan')}}">
            <span class="sidebar-section-nav__item-icon mdi mdi-account-group"></span>
            <span class="sidebar-section-nav__item-text">Upload Aktivitas</span>
        </a>
    </li>
    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link" href="{{url('relawan/laporan/kota/row')}}">
            <span class="sidebar-section-nav__item-icon mdi mdi-account-check"></span>
            <span class="sidebar-section-nav__item-text">Laporan</span>
        </a>
    </li>
    @php
    $validator = App\Model\Kandidat::where('group_id', App\Helper\Lib::auth()->group_id)->first();
    @endphp
    @if(!empty($validator))
    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link sidebar-section-nav__link-dropdown" href="#">
            <span class="sidebar-section-nav__item-icon mdi mdi-ray-end"></span>
            <span class="sidebar-section-nav__item-text">Quick Count</span>
        </a>
        <ul class="sidebar-section-subnav">
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('event/hasil-pendataan')}}">Hasil Pendataan</a></li>
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('event/hasil-pendataan/detail')}}">Detail Pendataan</a></li>
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('event/hasil-pendataan/detail/chart')}}">Detail Statistik</a></li>
        </ul>
    </li>
    @endif
    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link sidebar-section-nav__link-dropdown" href="#">
            <span class="sidebar-section-nav__item-icon mdi mdi-ray-end"></span>
            <span class="sidebar-section-nav__item-text">Setting</span>
        </a>
        <ul class="sidebar-section-subnav">
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('kandidat')}}">Data Caleg Partai</a></li>
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('dpt')}}">Import DPT</a></li>
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('setting/slider')}}">Slide Show</a></li>
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('setting/target')}}">Target Relawan & Saksi</a></li>
        </ul>
    </li>
</ul>
@endif

@if($auth->posisi == 'kabkota')
<ul class="sidebar-section-nav">
    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link" href="{{url('kordinator')}}">
            <span class="sidebar-section-nav__item-icon mdi mdi-home"></span>
            <span class="sidebar-section-nav__item-text">Halaman Utama</span>
        </a>
    </li>
    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link" href="{{url('kordinator/dl/'.$auth->anggota_id)}}">
            <span class="sidebar-section-nav__item-icon mdi mdi-account-multiple-plus"></span>
            <span class="sidebar-section-nav__item-text">Anggota</span>
        </a>
    </li>
    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link" href="{{url('activity/kegiatan')}}">
            <span class="sidebar-section-nav__item-icon mdi mdi-account-group"></span>
            <span class="sidebar-section-nav__item-text">Upload Aktivitas</span>
        </a>
    </li>
    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link sidebar-section-nav__link-dropdown" href="#">
            <span class="sidebar-section-nav__item-icon mdi mdi-ray-start"></span>
            <span class="sidebar-section-nav__item-text">Pra Event</span>
        </a>
        <ul class="sidebar-section-subnav">
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('event/hasil-pendataan/pra')}}">Hasil Pendataan</a></li>
        </ul>
    </li>

    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link sidebar-section-nav__link-dropdown" href="#">
            <span class="sidebar-section-nav__item-icon mdi mdi-ray-end"></span>
            <span class="sidebar-section-nav__item-text">Event</span>
        </a>
        <ul class="sidebar-section-subnav">
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('event/hasil-pendataan')}}">Hasil Pendataan</a></li>
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('event/hasil-pendataan/detail')}}">Detail Pendataan</a></li>
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('event/hasil-pendataan/detail/chart')}}">Detail Statistik</a></li>
        </ul>
    </li>
</ul>
@endif

@if($auth->posisi == 'kecamatan')
<ul class="sidebar-section-nav">
    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link" href="{{url('kordinator')}}">
            <span class="sidebar-section-nav__item-icon mdi mdi-home"></span>
            <span class="sidebar-section-nav__item-text">Halaman Utama</span>
        </a>
    </li>
    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link" href="{{url('kordinator/dl/'.$auth->anggota_id)}}">
            <span class="sidebar-section-nav__item-icon mdi mdi-account-multiple-plus"></span>
            <span class="sidebar-section-nav__item-text">Anggota</span>
        </a>
    </li>
    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link" href="{{url('activity/kegiatan')}}">
            <span class="sidebar-section-nav__item-icon mdi mdi-account-group"></span>
            <span class="sidebar-section-nav__item-text">Upload Aktivitas</span>
        </a>
    </li>
    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link sidebar-section-nav__link-dropdown" href="#">
            <span class="sidebar-section-nav__item-icon mdi mdi-ray-start"></span>
            <span class="sidebar-section-nav__item-text">Pra Event</span>
        </a>
        <ul class="sidebar-section-subnav">
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('event/hasil-pendataan/pra')}}">Hasil Pendataan</a></li>
        </ul>
    </li>

    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link sidebar-section-nav__link-dropdown" href="#">
            <span class="sidebar-section-nav__item-icon mdi mdi-ray-end"></span>
            <span class="sidebar-section-nav__item-text">Event</span>
        </a>
        <ul class="sidebar-section-subnav">
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('event/hasil-pendataan')}}">Hasil Pendataan</a></li>
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('event/hasil-pendataan/detail')}}">Detail Pendataan</a></li>
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('event/hasil-pendataan/detail/chart')}}">Detail Statistik</a></li>
        </ul>
    </li>
</ul>
@endif

@if($auth->posisi == 'kelurahan')
<ul class="sidebar-section-nav">
    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link" href="{{url('kordinator')}}">
            <span class="sidebar-section-nav__item-icon mdi mdi-home"></span>
            <span class="sidebar-section-nav__item-text">Halaman Utama</span>
        </a>
    </li>
    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link" href="{{url('kordinator/rtrw')}}">
            <span class="sidebar-section-nav__item-icon mdi mdi-account-multiple"></span>
            <span class="sidebar-section-nav__item-text">Koordinator RT / RW</span>
        </a>
    </li>
    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link" href="{{url('relawan/data')}}">
            <span class="sidebar-section-nav__item-icon mdi mdi-account-multiple"></span>
            <span class="sidebar-section-nav__item-text">Relawan</span>
        </a>
    </li>
    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link" href="{{url('activity/kegiatan')}}">
            <span class="sidebar-section-nav__item-icon mdi mdi-account-group"></span>
            <span class="sidebar-section-nav__item-text">Upload Aktivitas</span>
        </a>
    </li>
    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link sidebar-section-nav__link-dropdown" href="#">
            <span class="sidebar-section-nav__item-icon mdi mdi-ray-start"></span>
            <span class="sidebar-section-nav__item-text">Pra Event</span>
        </a>
        <ul class="sidebar-section-subnav">
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('event/hasil-pendataan/pra')}}">Hasil Pendataan</a></li>
        </ul>
    </li>

    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link sidebar-section-nav__link-dropdown" href="#">
            <span class="sidebar-section-nav__item-icon mdi mdi-ray-end"></span>
            <span class="sidebar-section-nav__item-text">Event</span>
        </a>
        <ul class="sidebar-section-subnav">
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('event/hasil-pendataan')}}">Hasil Pendataan</a></li>
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('event/hasil-pendataan/detail')}}">Detail Pendataan</a></li>
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('event/hasil-pendataan/detail/chart')}}">Detail Statistik</a></li>
        </ul>
    </li>
</ul>
@endif

@if($auth->posisi == 'rtrw')
<ul class="sidebar-section-nav">
    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link" href="{{url('kordinator')}}">
            <span class="sidebar-section-nav__item-icon mdi mdi-home"></span>
            <span class="sidebar-section-nav__item-text">Halaman Utama</span>
        </a>
    </li>
    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link" href="{{url('relawan/data')}}">
            <span class="sidebar-section-nav__item-icon mdi mdi-account-multiple"></span>
            <span class="sidebar-section-nav__item-text">Relawan</span>
        </a>
    </li>
    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link sidebar-section-nav__link-dropdown" href="#">
            <span class="sidebar-section-nav__item-icon mdi mdi-ray-start"></span>
            <span class="sidebar-section-nav__item-text">Pra Event</span>
        </a>
        <ul class="sidebar-section-subnav">
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('event/hasil-pendataan/pra')}}">Hasil Pendataan</a></li>
        </ul>
    </li>

    <li class="sidebar-section-nav__item">
        <a class="sidebar-section-nav__link sidebar-section-nav__link-dropdown" href="#">
            <span class="sidebar-section-nav__item-icon mdi mdi-ray-end"></span>
            <span class="sidebar-section-nav__item-text">Event</span>
        </a>
        <ul class="sidebar-section-subnav">
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('event/hasil-pendataan')}}">Hasil Pendataan</a></li>
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('event/hasil-pendataan/detail')}}">Detail Pendataan</a></li>
            <li class="sidebar-section-subnav__item"><a class="sidebar-section-subnav__link" href="{{url('event/hasil-pendataan/detail/chart')}}">Detail Statistik</a></li>
        </ul>
    </li>
</ul>
@endif