<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('/vendor-js/owl-carousel/css/owl.carousel.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('/vendor-js/owl-carousel/css/owl.theme.default.min.css') }} ">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Datatable -->
    <link href="{{ asset('vendor-js/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor-js/toastr/css/toastr.min.css') }}">
    <link href="{{ asset('/vendor-js/jqvmap/css/jqvmap.min.css') }} " rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<body>
  
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="index.html" class="brand-logo">
                <img class="logo-abbr" src="{{ asset('images/logo.png') }}" alt="">
                <img class="logo-compact" src="{{ asset('images/logo-text.png') }}" alt="">
                <img class="brand-title" src="{{ asset('images/logo-text.png') }}" alt="">
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">

                        <div class="header-left">

                            <!-- <div class="search_bar dropdown">
                                <span class="search_icon p-3 c-pointer" data-toggle="dropdown">
                                    <i class="mdi mdi-magnify"></i>
                                </span>
                                <div class="dropdown-menu p-0 m-0">
                                    <form>
                                        <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                                    </form>
                                </div>
                            </div>
                             -->
                        </div>

                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-bell"></i>
                                    <div class="pulse-css"></div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="list-unstyled">
                                        <li class="media dropdown-item">
                                            <span class="success"><i class="ti-user"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Martin</strong> has added a <strong>customer</strong>
                                                        Successfully
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="primary"><i class="ti-shopping-cart"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Jennifer</strong> purchased Light Dashboard 2.0.</p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="danger"><i class="ti-bookmark"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>Robin</strong> marked a <strong>ticket</strong> as
                                                        unsolved.
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="primary"><i class="ti-heart"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong>David</strong> purchased Light Dashboard 1.0.</p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                        <li class="media dropdown-item">
                                            <span class="success"><i class="ti-image"></i></span>
                                            <div class="media-body">
                                                <a href="#">
                                                    <p><strong> James.</strong> has added a<strong>customer</strong>
                                                        Successfully
                                                    </p>
                                                </a>
                                            </div>
                                            <span class="notify-time">3:20 am</span>
                                        </li>
                                    </ul>
                                    <a class="all-notification" href="#">See all notifications <i
                                            class="ti-arrow-right"></i></a>
                                </div>
                            </li>
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-account"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="./app-profile.html" class="dropdown-item">
                                        <i class="icon-user"></i>
                                        <span class="ml-2">Profile </span>
                                    </a>
                                    <a href="./email-inbox.html" class="dropdown-item">
                                        <i class="icon-envelope-open"></i>
                                        <span class="ml-2">Inbox </span>
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}">
                                       @csrf
                                           <button type="submit" href="./page-login.html" class="dropdown-item">
                                              <i class="icon-key"></i>
                                              <span class="ml-2">Logout </span>
                                          </button>
                                    </form>
                                
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label first">Main Menu</li>
                    <li>
                        <a  href="{{ route('home') }}" aria-expanded="false">
                            <i class="icon icon-single-04"></i>
                            <span class="nav-text">Dashboard</span></a>
                    </li>
                    
                    @if(isAdmin())
                    <li>
                        <a  href="{{ route('user.index') }}" aria-expanded="false">
                            <i class="icon icon-single-04"></i>
                            <span class="nav-text">Users</span>
                        </a>
                    </li>
                    @endif

                    <!-- <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon icon-single-04"></i><span class="nav-text">Dashboard</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./index.html">Users</a></li>
                            <li><a href="./index2.html">Dashboard 2</a></li>
                        </ul>
                    </li>
                     -->
                <!--     <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                    class="icon icon-chart-bar-33"></i><span class="nav-text">Charts</span></a>
                                <ul aria-expanded="false">
                <li><a href="./chart-flot.html">Flot</a></li>
                <li><a href="./chart-morris.html">Morris</a></li>
                <li><a href="./chart-chartjs.html">Chartjs</a></li>
                <li><a href="./chart-chartist.html">Chartist</a></li>
                <li><a href="./chart-sparkline.html">Sparkline</a></li>
                <li><a href="./chart-peity.html">Peity</a></li>
                                </ul>
                            </li> -->
            

                </ul>
            </div>


        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
              
               @yield('content')


            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="#" target="_blank">Quixkit</a> 2019</p>
                <p>Distributed by <a href="https://themewagon.com/" target="_blank">Themewagon</a></p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->

    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    
    
        <!-- Required vendors -->
    <script src="{{ asset('/vendor-js/global/global.min.js' ) }} "></script>
    <script src="{{ asset('/js/quixnav-init.js' ) }} "></script>
    <script src="{{ asset('/js/custom.min.js' ) }} "></script>


    <!-- Vectormap -->
    <script src="{{ asset('/vendor-js/raphael/raphael.min.js' ) }} "></script>
    <script src="{{ asset('/vendor-js/morris/morris.min.js' ) }} "></script>


    <script src="{{ asset('/vendor-js/circle-progress/circle-progress.min.js' ) }} "></script>

    <!--  flot-chart js -->
    <script src="{{ asset('/vendor-js/flot/jquery.flot.js' ) }} "></script>
    <script src="{{ asset('/vendor-js/flot/jquery.flot.resize.js' ) }} "></script>

    <!-- Owl Carousel -->
    <script src="{{ asset('/vendor-js/owl-carousel/js/owl.carousel.min.js' ) }} "></script>

    <!-- Counter Up -->
    <script src="{{ asset('/vendor-js/jqvmap/js/jquery.vmap.min.js' ) }} "></script>
    <script src="{{ asset('/vendor-js/jqvmap/js/jquery.vmap.usa.js' ) }} "></script>
    <script src="{{ asset('/vendor-js/jquery.counterup/jquery.counterup.min.js' ) }} "></script>

    <script src="{{ asset('/js/dashboard/dashboard-1.js' ) }} "></script>
    
    <!-- Datatable -->
    <script src="{{ asset('vendor-js/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins-init/datatables.init.js') }}"></script>
    
    <!-- Toastr -->
    <script src="{{ asset('vendor-js/toastr/js/toastr.min.js') }}"></script>

    <!-- All init script -->
<!--     <script src="{{ asset('js/plugins-init/toastr-init.js') }}"></script> -->

@stack('js')


<script>
  let tosterOption = {
                    positionClass: "toast-top-right",
                    timeOut: 5e3,
                    closeButton: !0,
                    debug: !1,
                    newestOnTop: !0,
                    progressBar: !0,
                    preventDuplicates: !0,
                    onclick: null,
                    showDuration: "300",
                    hideDuration: "1000",
                    extendedTimeOut: "1000",
                    showEasing: "swing",
                    hideEasing: "linear",
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    tapToDismiss: !1
                };
</script>

@if(session()->has('success'))
  <script>
      toastr.success("Success",'{{  session()->get("success") }}' , tosterOption);
  </script>
@endif

@if( session()->has('info') )
<script>
  toastr.info("Info",'{{  session()->get("info") }}' , tosterOption);
</script>
@endif

@if( session()->has('error') )
<script>
  toastr.success("Error",'{{  session()->get("error") }}' , tosterOption);
</script>
@endif

@if( session()->has('warning') )
<script>
  toastr.warning("Warning",'{{  session()->get("warning") }}' , tosterOption);
</script>
@endif
</body>
</html>
