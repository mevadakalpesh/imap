<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link rel="stylesheet" href="{{ asset('/vendor-js/owl-carousel/css/owl.carousel.min.css') }} ">
    <link rel="stylesheet" href="{{ asset('/vendor-js/owl-carousel/css/owl.theme.default.min.css') }} ">
    <link href="{{ asset('/vendor-js/jqvmap/css/jqvmap.min.css') }} " rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    
  
</head>
<body>
  
  <div id="main-wrapper">

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


</body>
</html>
