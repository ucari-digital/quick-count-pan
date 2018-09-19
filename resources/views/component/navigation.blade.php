@php
$auth = App\Helper\Lib::auth();
@endphp
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
                <div class="nav-profile-image">
                    <img src="{{url(''.$auth->foto)}}" alt="profile">
                    <span class="login-status online"></span> <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                    <span class="font-weight-bold mb-2">{{str_limit($auth->name, '12')}}</span>
                    <span class="text-secondary text-small">{{ucwords($auth->role)}} - {{ucwords(App\Helper\Lib::translatePosisi($auth->posisi))}}</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url($auth->role)}}">
                <span class="menu-title">Halaman Utama</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        @if($auth->posisi == 'superadmin')
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#kordinator" aria-expanded="false" aria-controls="kordinator">
                <span class="menu-title">Kordinator</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-account-star menu-icon"></i>
            </a>
            <div class="collapse" id="kordinator">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{url('kordinator/pusat')}}">Pusat</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('kordinator/kabkota')}}">Kabupaten / Kota</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('kordinator/kecamatan')}}">Kecamatan</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('kordinator/kelurahan')}}">Kelurahan</a></li>
                    {{-- <li class="nav-item"> <a class="nav-link" href="{{url('kordinator/rtrw')}}">RT / RW</a></li> --}}
                </ul>
            </div>
        </li>
        @endif
        @if($auth->role == 'kordinator' && $auth->posisi != 'kelurahan')
        <li class="nav-item">
            <a class="nav-link" href="{{url('kordinator/dl/'.$auth->anggota_id)}}">
                <span class="menu-title">Anggota</span>
                <i class="mdi mdi-account-star menu-icon"></i>
            </a>
        </li>
        @endif
        @if($auth->role == 'kordinator' && $auth->posisi == 'kelurahan' || $auth->posisi == 'superadmin')
        <li class="nav-item">
            <a class="nav-link" href="{{url('relawan/data')}}">
                <span class="menu-title">Relawan</span>
                <i class="mdi mdi-account-multiple menu-icon"></i>
            </a>
        </li>
        @endif
        @if($auth->role == 'relawan' || $auth->posisi == 'superadmin')
        <li class="nav-item">
            <a class="nav-link" href="{{url('pemilih/data')}}">
                <span class="menu-title">Pemilih</span>
                <i class="mdi mdi-account-plus menu-icon"></i>
            </a>
        </li>
        @endif
        {{-- QUICK COUNT FEATURE --}}
        @if($auth->role == 'kordinator')
        <li class="nav-item mt-4">
            <small style="color: #9e9e9e;">Quic Count</small>
        </li>
            @if($auth->posisi == 'kabkota')
            <li class="nav-item">
                <a class="nav-link" href="{{url('kandidat')}}">
                    <span class="menu-title">Data Kandidat</span>
                    <i class="mdi mdi-account-check menu-icon"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('dpt')}}">
                    <span class="menu-title">Data DPT</span>
                    <i class="mdi mdi-book-open menu-icon"></i>
                </a>
            </li>
            @endif
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#praevent" aria-expanded="false" aria-controls="praevent">
                <span class="menu-title">Pra Event</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-ray-start menu-icon"></i>
            </a>
            <div class="collapse" id="praevent">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{url('event/hasil-pendataan/pra')}}">Hasil Pendataan</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#event" aria-expanded="false" aria-controls="event">
                <span class="menu-title">Event</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-ray-end menu-icon"></i>
            </a>
            <div class="collapse" id="event">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{url('event/hasil-pendataan')}}">Hasil Pendataan</a></li>
                </ul>
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{url('event/hasil-pendataan/detail')}}">Detail Pendataan</a></li>
                </ul>
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{url('event/hasil-pendataan/detail/chart')}}">Detail Statistik</a></li>
                </ul>
            </div>
        </li>
        @endif
        @if($auth->posisi == 'saksi')
        <li class="nav-item mt-4">
            <small style="color: #9e9e9e;">Quic Count</small>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('event/pendataan/input/pra-event/')}}">
                <span class="menu-title">Pendataan Pra Even</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('event/pendataan/input/event/')}}">
                <span class="menu-title">Input Hasil Pemilihan</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        @endif
    </ul>
</nav>