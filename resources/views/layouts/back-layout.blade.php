<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
    <meta name="keywords" content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
    <meta name="author" content="PIXINVENT">
    <title>Grandeur Palace Dashboard</title>
    <link rel="apple-touch-icon" href="{{asset('assets/admin/images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/admin/images/ico/favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
          rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
          rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/vendors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/vendors/css/weather-icons/climacons.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/fonts/meteocons/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/vendors/css/charts/morris.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/vendors/css/charts/chartist.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/vendors/css/charts/chartist-plugin-tooltip.css')}}">
    <!-- END VENDOR CSS-->
    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/app.css')}}">
    <!-- END MODERN CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/fonts/simple-line-icons/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/pages/timeline.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/pages/dashboard-ecommerce.css')}}">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- END Custom CSS-->
    @stack('styles')
</head>
<body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar"
      data-open="click" data-menu="vertical-menu" data-col="2-columns">

    @include('admin.sections.navigation')

    @include('admin.sections.sidebar')

    @yield('content')

    @include('admin.sections.footer')

    <!-- BEGIN VENDOR JS-->
    <script src="{{asset('assets/admin/vendors/js/vendors.min.js')}}" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{asset('assets/admin/vendors/js/charts/chartist.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/vendors/js/charts/chartist-plugin-tooltip.min.js')}}"
            type="text/javascript"></script>
    <script src="{{asset('assets/admin/vendors/js/charts/raphael-min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/vendors/js/charts/morris.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/vendors/js/timeline/horizontal-timeline.js')}}" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN MODERN JS-->
    <script src="{{asset('assets/admin/js/core/app-menu.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/js/core/app.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/js/scripts/customizer.js')}}" type="text/javascript"></script>
    <!-- END MODERN JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{asset('assets/admin/js/scripts/pages/dashboard-ecommerce.js')}}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" integrity="sha512-uKQ39gEGiyUJl4AI6L+ekBdGKpGw4xJ55+xyJG7YFlJokPNYegn9KwQ3P8A7aFQAUtUsAQHep+d/lrGqrbPIDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @vite(['resources/js/app.js'])
    @stack('scripts')
</body>
</html>
