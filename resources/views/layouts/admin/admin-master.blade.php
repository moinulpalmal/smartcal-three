<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    {{--<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="{{ asset('imageFolder/addressbarLogo.png') }}">--}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Smart Cal Three - @yield('title')</title>
    <link rel="icon" type="image/ico" href="{{ asset('/') }}back-end/assets/images/favicon.ico" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- ============================================
    ================= Stylesheets ===================
    ============================================= -->
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset('/') }}back-end/assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}back-end/assets/css/vendor/animate.css">
    <link rel="stylesheet" href="{{ asset('/') }}back-end/assets/css/vendor/font-awesome.min.css">
    {{--    <link rel="stylesheet" href="{{ asset('/') }}back-end/assets/fontawesome-5.14.0/css/fontawesome.css">--}}
    <link rel="stylesheet" href="{{ asset('/') }}back-end/assets/js/vendor/animsition/css/animsition.min.css">
    {{--    <link rel="stylesheet" href="{{ asset('/') }}back-end/assets/js/vendor/daterangepicker/daterangepicker-bs3.css">--}}
    <link rel="stylesheet" href="{{ asset('/') }}back-end/assets/js/vendor/morris/morris.css">
    {{--    <link rel="stylesheet" href="{{ asset('/') }}back-end/assets/js/vendor/owl-carousel/owl.carousel.css">--}}
    {{--    <link rel="stylesheet" href="{{ asset('/') }}back-end/assets/js/vendor/owl-carousel/owl.theme.css">--}}
    <link rel="stylesheet" href="{{ asset('/') }}back-end/assets/js/vendor/rickshaw/rickshaw.min.css">
    {{--    <link rel="stylesheet" href="{{ asset('/') }}back-end/assets/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">--}}
    {{--    <link rel="stylesheet" href="{{ asset('back-end/assets/MyCSS/dataTables.bootstrap.min.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('/') }}back-end/assets/js/vendor/datatables/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}back-end/assets/js/vendor/datatables/datatables.bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}back-end/assets/js/vendor/chosen/chosen.css">
    <link rel="stylesheet" href="{{ asset('/') }}back-end/assets/js/vendor/summernote/summernote.css">
    <link rel="stylesheet" href="{{ asset('/') }}back-end/assets/css/arifcss.css">
    <link rel="stylesheet" href="{{ asset('/')}}back-end/assets/MyCSS/select2.min.css">
    <link rel="stylesheet" href="{{ asset('/')}}back-end/assets/css/vendor/simple-line-icons.css">
    <link rel="stylesheet" href="{{ asset('/')}}back-end/assets/css/vendor/weather-icons.min.css">
    <!-- project main css files -->
    <link rel="stylesheet" href="{{ asset('/') }}back-end/assets/css/main.css">
{{--    <link rel="stylesheet" href="{{ asset('/') }}back-end/assets/MyCSS/myHexagon.css">--}}
<!-- ==========================================
    ================= Modernizr ===================
    =========================================== -->
    <script src="{{ asset('/') }}back-end/assets/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body id="minovate" class="appWrapper hz-menu ">
<div class="animsition" id="wrap">
    {{--    fixed header --}}
    @include('layouts.admin.header')
    {{--    fixed header --}}
    <!-- =================================================
    ================= CONTROLS Content ===================
    ================================================== -->
    @include('layouts.admin.nav-bar')
    <!--/ CONTROLS Content -->
    <section {{--id="content"--}} id = "content">
        @yield('content')
    </section>
        @yield('page-modals')
</div>
{{--venddor scripts--}}
<!-- ============================================
        ============== Vendor JavaScripts ===============
        ============================================= -->
@yield('pageVendorScripts')




<script src="{{ asset('/') }}back-end/assets/js/vendor/jquery/jquery-1.11.2.min.js"></script>
<script src="{{ asset('/') }}back-end/assets/js/vendor/bootstrap/bootstrap.min.js"></script>
<script src="{{ asset('/') }}back-end/assets/js/vendor/jRespond/jRespond.min.js"></script>
<script src="{{ asset('/') }}back-end/assets/js/vendor/d3/d3.min.js"></script>
<script src="{{ asset('/') }}back-end/assets/js/vendor/d3/d3.layout.min.js"></script>
<script src="{{ asset('/') }}back-end/assets/js/vendor/rickshaw/rickshaw.min.js"></script>
<script src="{{ asset('/') }}back-end/assets/js/vendor/sparkline/jquery.sparkline.min.js"></script>
<script src="{{ asset('/') }}back-end/assets/js/vendor/slimscroll/jquery.slimscroll.min.js"></script>
<script src="{{ asset('/') }}back-end/assets/js/vendor/animsition/js/jquery.animsition.min.js"></script>
<script src="{{ asset('/') }}back-end/assets/js/vendor/raphael/raphael-min.js"></script>
<script src="{{ asset('/') }}back-end/assets/js/vendor/morris/morris.min.js"></script>
<script src="{{ asset('/') }}back-end/assets/js/vendor/owl-carousel/owl.carousel.min.js"></script>
<script src="{{ asset('/') }}back-end/assets/js/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('/') }}back-end/assets/js/vendor/datatables/extensions/dataTables.bootstrap.js"></script>
<script src="{{ asset('/') }}back-end/assets/js/vendor/chosen/chosen.jquery.min.js"></script>
<script src="{{ asset('/') }}back-end/assets/js/vendor/summernote/summernote.min.js"></script>
<script src="{{ asset('back-end/assets/MyJS/sweetalert.js') }}"></script>
<script src="{{ asset('back-end/assets/MyJS/select2.full.min.js') }}"></script>
<script src="{{ asset('/') }}back-end/assets/js/vendor/classie/classie.js"></script>
<!--/ vendor javascripts -->
<!-- ============================================
============== Custom JavaScripts ===============
============================================= -->
<script src="{{ asset('/') }}back-end/assets/js/main.js"></script>
@yield('pageScripts')
<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->

</body>
<!-- Mirrored from adminlte.io/themes/AdminLTE/pages/layout/top-nav.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 28 Oct 2019 19:00:43 GMT -->
</html>


