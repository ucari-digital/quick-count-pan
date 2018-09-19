<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <title>Sales Dashboard / Universe Admin</title>
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
        
        <script src="{{url('js/ie.assign.fix.min.js')}}"></script>
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
                    <img src="img/users/user-3.png" alt="" class="navbar-dropdown-toggle__user-avatar">
                    <span class="navbar-dropdown__user-name">John Smith</span>
                </a>
                <div class="dropdown-menu navbar-dropdown-menu navbar-dropdown-menu__user">
                    <div class="navbar-dropdown-user-content">
                        <div class="dropdown-user__avatar"><img src="img/users/user-3.png" alt=""/></div>
                        <div class="dropdown-info">
                            <div class="dropdown-info__name">John Smith</div>
                            <div class="dropdown-info__job">Manager</div>
                            <div class="dropdown-info-buttons"><a class="dropdown-info__viewprofile" href="#">View Profile</a><a class="dropdown-info__addaccount" href="#">Add account</a></div>
                        </div>
                        </div><a class="dropdown-item navbar-dropdown__item" href="#">Upgrade to <span>PRO</span></a><a class="dropdown-item navbar-dropdown__item" href="#">Invite team member</a><a class="dropdown-item navbar-dropdown__item" href="#">Fedback</a><a class="dropdown-item navbar-dropdown__item" href="#">Help</a><a class="dropdown-item navbar-dropdown__item" href="#">Sign Out</a>
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
                        <img src="img/users/user-19.png" alt="" class="sidebar-user-a__avatar rounded-circle">
                        <div class="sidebar-user-a__name">Martha Howard</div>
                        <div class="sidebar-user-a__desc">Product Manager</div>
                    </div>
                    <div>
                        @include('component.menu')
                    </div>
                    <div class="sidebar-section__separator">Social Toolkit</div>
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
                @yield('content')
            </div>
        </div>
    </div>
    <script src="vendor/echarts/echarts.min.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/select2/js/select2.full.min.js"></script>
    <script src="vendor/simplebar/simplebar.js"></script>
    <script src="vendor/text-avatar/jquery.textavatar.js"></script>
    <script src="vendor/tippyjs/tippy.all.min.js"></script>
    <script src="vendor/flatpickr/flatpickr.min.js"></script>
    <script src="vendor/wnumb/wNumb.js"></script>
    <script src="js/main.js"></script>
    <script src="vendor/sparkline/jquery.sparkline.min.js"></script>
    <script src="js/preview/sales-dashboard.min.js"></script>
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