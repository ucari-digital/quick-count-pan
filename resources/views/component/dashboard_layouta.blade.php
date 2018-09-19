<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Quick Counteee</title>
        <!-- plugins:css -->
        <link rel="stylesheet" href="{{url('vendors/iconfonts/mdi/css/materialdesignicons.min.css')}}">
        <link rel="stylesheet" href="{{url('vendors/css/vendor.bundle.base.css')}}">
        <link rel="stylesheet" href="{{url('css/qc.css')}}">
        <link rel="stylesheet" href="{{url('css/datatables.min.css')}}">
        <link rel="stylesheet" href="{{url('css/selectize.default.css')}}">
        <!-- endinject -->
        <!-- inject:css -->
        <link rel="stylesheet" href="{{url('css/style.css')}}">
        <!-- endinject -->
        <link rel="shortcut icon" href="images/favicon.png" />
        <script src="{{url('js/Chart.min.js')}}"></script>

        @php
        $auth = App\Helper\Lib::auth();
        @endphp
    </head>
    <body>
        <div class="container-scroller">
            <!-- partial:partials/_navbar.html -->
            <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
                <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo" href="index.html"><img src="{{url('storage/assets/logo.png')}}" alt="logo"/></a>
                    <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo-mini.svg" alt="logo"/></a>
                </div>
                <div class="navbar-menu-wrapper d-flex align-items-stretch">
                    {{-- <div class="search-field d-none d-md-block">
                        <form class="d-flex align-items-center h-100" action="#">
                            <div class="input-group">
                                <div class="input-group-prepend bg-transparent">
                                    <i class="input-group-text border-0 mdi mdi-magnify"></i>
                                </div>
                                <input type="text" class="form-control bg-transparent border-0" placeholder="Search projects">
                            </div>
                        </form>
                    </div> --}}
                    {{-- <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item nav-profile dropdown">
                            <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                                <div class="nav-profile-img">
                                    <img src="{{url(''.$auth->foto)}}" alt="image">
                                    <span class="availability-status online"></span>
                                </div>
                                <div class="nav-profile-text">
                                    <p class="mb-1 text-black">{{$auth->name}}</p>
                                </div>
                            </a>
                            <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                                <a class="dropdown-item" href="{{url('profil')}}">
                                    <i class="mdi mdi-cached mr-2 text-success"></i>
                                    Profil
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{url('logout')}}">
                                    <i class="mdi mdi-logout mr-2 text-primary"></i>
                                    Signout
                                </a>
                            </div>
                        </li>
                        <li class="nav-item d-none d-lg-block full-screen-link">
                            <a class="nav-link">
                                <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                            </a>
                        </li>
                        <li class="nav-item nav-logout d-none d-lg-block">
                            <a class="nav-link" href="{{url('logout')}}">
                                <i class="mdi mdi-power"></i>
                            </a>
                        </li>
                    </ul> --}}
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                    </button>
                </div>
            </nav>
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_sidebar.html -->
                @include('component.navigation')
                <!-- partial -->
                <div class="main-panel">
                    <div class="content-wrapper">
                        @yield('breadcrumb')
                        @yield('content')
                    </div>
                    <!-- content-wrapper ends -->
                    <!-- partial:partials/_footer.html -->
                    <footer class="footer">
                        <div class="d-sm-flex justify-content-center justify-content-sm-between">
                            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2017 <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap Dash</a>. All rights reserved.</span>
                            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
                        </div>
                    </footer>
                    <!-- partial -->
                </div>
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->
        <!-- plugins:js -->
        <script src="{{url('js/jquery-3.3.1.min.js')}}"></script>
        <script src="{{url('js/popper.js')}}"></script>
        <script src="{{url('js/bootstrap.min.js')}}"></script>
        <!-- endinject -->
        <!-- Plugin js for this page-->
        <!-- End plugin js for this page-->
        <!-- inject:js -->
        <script src="{{url('js/off-canvas.js')}}"></script>
        <script src="{{url('js/misc.js')}}"></script>
        <!-- endinject -->
        <!-- Custom js for this page-->
        <script src="{{url('js/dashboard.js')}}"></script>
        <script src="{{url('js/datatables.min.js')}}"></script>
        <script src="{{url('js/selectize.min.js')}}"></script>
        <script src="https://unpkg.com/imask"></script>
        <!-- End custom js for this page-->
        <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function () {
                var dateMask = new IMask(
                    document.getElementById('date-mask'),
                    {
                        mask: Date,
                        min: new Date(1900, 0, 1),
                        max: new Date(2050, 0, 1),
                        lazy: false
                    }
                );
            });
            $(document).ready( function () {
                $('.selectjs').selectize();
                $('#dtable').DataTable();
                var t = $('.dtable-r').DataTable( {
                    "dom": "<'row mt-4' <'col-md-6'l><'col-md-6'f>><'row justify-content-end' <'col-md-4'<'float-right'B>> ><'table-responsive'tr> <'row mt-2' <'col-md-6'i><'col-md-6'p>>"
                } );
                t.on( 'order.dt search.dt', function () {
                    t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                        cell.innerHTML = i+1;
                    } );
                } ).draw();
            } );
        </script>
        @yield('footer')
    </body>
</html>