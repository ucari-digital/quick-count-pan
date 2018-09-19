<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Purple Admin</title>
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
    <body class="p-front">
        <div class="navbar navbar-light navbar-expand-lg p-front__navbar" style="height: 70px;"> <!-- is-dark -->
            <a class="navbar-brand" href="/"><img src="{{url('img/qc/logo.png')}}" alt="" style="width: 300px; padding: 25px;" /></a>
            <a class="navbar-brand-sm" href="/"><img src="img/logo-sm.png" alt=""/></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" style="top: 30px;">
            <span class="ua-icon-navbar-open navbar-toggler__open"></span>
            <span class="ua-icon-alert-close navbar-toggler__close"></span>
            </button>
        </div>
        <div class="p-front__content">
            <div class="p-signin-a">
                <form action="{{url('login/submit')}}" method="post" class="p-signin-a__form">
                    @if(session('status') == 'success')
                    <div class="alert alert-success" role="alert">
                        {{session('message')}}
                    </div>
                    @elseif(session('status') == 'failed')
                    <div class="alert alert-danger" role="alert">
                        {{session('message')}}
                    </div>
                    @endif
                    @csrf
                    <h4 class="p-signin-a__form-heading">Masuk</h4>
                    <p class="p-signin-a__form-description">
                        Create a personal account to keep track of your progress.
                    </p>
                    
                    <div class="form-group">
                        <input name="anggota_id" type="text" class="form-control form-control-lg" placeholder="User ID">
                    </div>
                    <div class="form-group">
                        <input name="password" type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-info btn-lg btn-block btn-rounded" type="button">Sign In</button>
                    </div>
                </form>
                <div class="p-signin-a__form-link">Already have an account? <a href="signup.html">Sign Up</a></div>
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
        <script src="{{url('js/preview/sales-dashboard.min.js')}}"></script>
    </body>
</html>