<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <title>@yield('title')</title>
        <link rel="shortcut icon" href="img/favicon.png">
        
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
        <style type="text/css">
            input[type="file"].form-control{
                height: 40px;
            }
        </style>
        <script src="{{url('js/ie.assign.fix.min.js')}}"></script>
        <script src="{{url('js/Chart.min.js')}}"></script>
    </head>
    <body class="js-loading "> <!-- add for rounded corners: form-controls-rounded -->
    <div class="page-preloader js-page-preloader">
        <div class="page-preloader__logo">
            <!-- <img src="img/logo-black-lg.png" alt="" class="page-preloader__logo-image"> -->
        </div>
        <div class="page-preloader__desc">Quick Count</div>
        <div class="page-preloader__loader">
            <div class="page-preloader__loader-heading">System Loading</div>
            <div class="page-preloader__loader-desc">Widgets update</div>
            <div class="progress progress-rounded page-preloader__loader-progress">
                <div id="page-loader-progress-bar" class="progress-bar bg-info" role="progressbar" style="width: 10%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
        <div class="page-preloader__copyright">Ucari Digital Indonesia</div>
    </div>
    <div class="navbar navbar-light navbar-expand-lg">
        <button class="sidebar-toggler" type="button">
        <span class="ua-icon-sidebar-open sidebar-toggler__open"></span>
        <span class="ua-icon-alert-close sidebar-toggler__close"></span>
        </button>
        <span class="navbar-brand">
            <a href="/"><img src="img/logo.png" alt="" class="navbar-brand__logo"></a>
            {{-- <span class="ua-icon-menu slide-nav-toggle"></span> --}}
        </span>
        <span class="navbar-brand-sm">
            <a href="/"><img src="img/logo-sm.png" alt="" class="navbar-brand__logo"></a>
            {{-- <span class="ua-icon-menu slide-nav-toggle"></span> --}}
        </span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse">
        <span class="ua-icon-navbar-open navbar-toggler__open"></span>
        <span class="ua-icon-alert-close navbar-toggler__close"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <div class="navbar__menu"></div>
            <div class="dropdown navbar-dropdown">
                <a class="dropdown-toggle navbar-dropdown-toggle navbar-dropdown-toggle__user" data-toggle="dropdown" href="#">
                    <img src="{{url(''.$auth->foto)}}" alt="" class="navbar-dropdown-toggle__user-avatar">
                    <span class="navbar-dropdown__user-name">{{$auth->name}}</span>
                </a>
                <div class="dropdown-menu navbar-dropdown-menu navbar-dropdown-menu__user">
                    <div class="navbar-dropdown-user-content">
                        <div class="dropdown-user__avatar"><img src="{{url(''.$auth->foto)}}" alt=""/></div>
                        <div class="dropdown-info">
                            <div class="dropdown-info__name">{{$auth->name}}</div>
                            <div class="dropdown-info__job">{{ucwords(App\Helper\Lib::translatePosisi($auth->posisi))}}</div>
                            <div class="dropdown-info-buttons"><a class="dropdown-info__viewprofile" href="{{url('profil')}}">View Profile</a></div>
                        </div>
                        </div>
                        <a class="dropdown-item navbar-dropdown__item" href="{{url('logout')}}">Sign Out</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-wrap">
            
            <div class="sidebar-section">
                <div class="sidebar-section__scroll">
 <!--                    <div class="sidebar-section__user has-background">
                        <img src="img/users/user-19.png" alt="" class="sidebar-section__user-avatar rounded-circle">
                        <div class="dropdown sidebar-section__user-dropdown">
                            <a class="dropdown-toggle sidebar-section__user-dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Joyce Walsh
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="#">Settings</a>
                                <a class="dropdown-item" href="#">Help</a>
                                <a class="dropdown-item" href="#">Sign Out</a>
                            </div>
                        </div>
                    </div> -->
                    <div class="sidebar-user-a">
                        <img src="{{url(''.$auth->foto)}}" alt="" class="sidebar-user-a__avatar rounded-circle">
                        <div class="sidebar-user-a__name">{{str_limit($auth->name, '12')}}</div>
                        <div class="sidebar-user-a__desc">{{ucwords($auth->role)}} - {{ucwords(App\Helper\Lib::translatePosisi($auth->posisi))}}</div>
                    </div>
                    <div>
                        @include('component.menu')
                    </div>
                    <div class="sidebar-section__separator">&nbsp;</div>
                </div>
                <!--<div class="sidebar-section-nav__footer">
                    <ul class="sidebar-section-nav">
                        <li class="sidebar-section-nav__item sidebar-section-nav__item-btn mb-4">
                            <a href="#" class="btn btn-info btn-block">Create project</a>
                        </li>
                    </ul>
                    <div class="sidebar__collapse">
                        <span class="icon ua-icon-collapse-left-arrows"></span>
                    </div>
                </div>
            </div>
            -->
        </div>
        
        <div class="page-content">
            
            <div class="container-fluid">
                @yield('breadcrumb')
                @yield('content')
            </div>
        </div>
    </div>
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
    <script src="https://unpkg.com/imask"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('select').select2();
            $('.nik').keyup(function(){
                $.get('{{url('search_anggota')}}/'+this.value, function(data){
                    var str_tempat = data.ttl;
                    var tempat = str_tempat.split(',');
                    var str_thn = tempat[1].split('-');
                    $('input[name="name"]').val(data.name);
                    $('select[name="jk"]').html($("<option></option>")
                        .attr("value",data.jk)
                        .text(data.jk));
                    $('input[name="tempat"]').val(tempat[0]);
                    $('input[name="tgl_lahir"]').val(str_thn[2]+'-'+str_thn[1]+'-'+str_thn[0]);
                    $('input[name="alamat"]').val(data.alamat);
                    $('input[name="rtrw"]').val(data.rtrw);

                    // Add select wilayah
                    $("select[name='provinsi']").val(data.provinsi).trigger('change.select2');
                    $.get('{{url('kota')}}/'+data.provinsi, function(c){
                        $.each(c, function(key, value) {  
                            console.log(value);
                            $('.kabkota')
                            .append($("<option></option>")
                                .attr("value",value.id)
                                .text(value.name)); 
                        });
                        $("select[name='kabkota']").val(data.kabkota).trigger('change.select2');
                    });

                    $.get('{{url('kecamatan')}}/'+data.kabkota, function(c){
                        $.each(c, function(key, value) {  
                            $('.kecamatan')
                            .append($("<option></option>")
                                .attr("value",value.id)
                                .text(value.name)); 
                        });
                        $("select[name='kecamatan']").val(data.kecamatan).trigger('change.select2');
                    });

                    $.get('{{url('kelurahan')}}/'+data.kecamatan, function(c){
                        $.each(c, function(key, value) {  
                            $('.kelurahan')
                            .append($("<option></option>")
                                .attr("value",value.id)
                                .text(value.name)); 
                        });
                        $("select[name='kelurahan']").val(data.kelurahan).trigger('change.select2');
                    });

                    var array = data.name.split(' ');
                    $("input[name=anggota_id]").val(array[0]+getRandomInt(99))

                });
            });
        });
        var el = document.getElementById('date-mask');
        if (el) {
            var dateMask = new IMask(
                el,
                {
                    mask: Date,
                    min: new Date(1900, 0, 1),
                    max: new Date(2050, 0, 1),
                    lazy: false
                }
            );
        }

        // $('.dtable-rs').DataTable();
        //     var t = $('.dtable-r').DataTable( {
        //         "dom": "<'row mt-4' <'col-md-6'l><'col-md-6'f>><'row justify-content-end' <'col-md-4'<'float-right'B>> ><'table-responsive'tr> <'row mt-2' <'col-md-6'i><'col-md-6'p>>"
        //     } );
        //     t.on( 'order.dt search.dt', function () {
        //         t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        //             cell.innerHTML = i+1;
        //         } );
        //     } ).draw();
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
    @yield('footer')
    <div class="slide-nav">
        <div class="slide-nav__header">
            <a href="#" class="slide-nav__back ua-icon-step-arrow-left"></a>
            <img src="img/logo.png" alt="" class="slide-nav__logo">
        </div>
        <div class="slide-nav__body">
            <div class="slide-nav__scrollpane js-scrollable">
                <div class="slide-nav__items">
                    <a href="#" class="slide-nav__item">
                        <img src="img/slidenav/30.png" alt="" class="slide-nav__item-image">
                        <span class="slide-nav__item-text">Storage</span>
                    </a>
                    <a href="#" class="slide-nav__item">
                        <img src="img/slidenav/31.png" alt="" class="slide-nav__item-image">
                        <span class="slide-nav__item-text">Search</span>
                    </a>
                    <a href="#" class="slide-nav__item">
                        <img src="img/slidenav/32.png" alt="" class="slide-nav__item-image">
                        <span class="slide-nav__item-text">Calendar</span>
                    </a>
                    <a href="#" class="slide-nav__item">
                        <img src="img/slidenav/33.png" alt="" class="slide-nav__item-image">
                        <span class="slide-nav__item-text">Mail</span>
                    </a>
                    <a href="#" class="slide-nav__item">
                        <img src="img/slidenav/34.png" alt="" class="slide-nav__item-image">
                        <span class="slide-nav__item-text">Images</span>
                    </a>
                    <a href="#" class="slide-nav__item">
                        <img src="img/slidenav/35.png" alt="" class="slide-nav__item-image">
                        <span class="slide-nav__item-text">News</span>
                    </a>
                    <a href="#" class="slide-nav__item">
                        <img src="img/slidenav/36.png" alt="" class="slide-nav__item-image">
                        <span class="slide-nav__item-text">Maps</span>
                    </a>
                    <a href="#" class="slide-nav__item">
                        <img src="img/slidenav/37.png" alt="" class="slide-nav__item-image">
                        <span class="slide-nav__item-text">Market</span>
                    </a>
                    <a href="#" class="slide-nav__item">
                        <img src="img/slidenav/38.png" alt="" class="slide-nav__item-image">
                        <span class="slide-nav__item-text">Weather</span>
                    </a>
                    <a href="#" class="slide-nav__item">
                        <img src="img/slidenav/39.png" alt="" class="slide-nav__item-image">
                        <span class="slide-nav__item-text">Music</span>
                    </a>
                    <a href="#" class="slide-nav__item">
                        <img src="img/slidenav/40.png" alt="" class="slide-nav__item-image">
                        <span class="slide-nav__item-text">Tickets</span>
                    </a>
                    <a href="#" class="slide-nav__item">
                        <img src="img/slidenav/41.png" alt="" class="slide-nav__item-image">
                        <span class="slide-nav__item-text">Stats</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script src="{{url('js/preview/slide-nav.min.js')}}"></script>
</body>
</html>