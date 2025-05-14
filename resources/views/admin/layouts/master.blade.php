<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="S-Commerce admin.">
    <meta name="keywords" content="">
    <meta name="author" content="SoftScholar">
    <link rel="shortcut icon" href="{{ asset('admin-assets/images/logo/favicon.ico') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('admin-title') | {{ \App\Constants\AdminConstant::APP_NAME }} </title>

    @include('admin.partials.styles')
    @yield('admin-styles')

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">

    <!-- BEGIN: Header-->
    @include('admin.partials.nav')
    @include('admin.partials.searchbar')
    <!-- END: Header-->

    @include('admin.partials.sidebar')

    <!-- BEGIN: Content-->
    <div class="app-content content" id="admin-app">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            @yield('admin-content')
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    @include('admin.partials.footer')
    @include('admin.partials.scripts')
    @yield('admin-scripts')
    @vite('resources/js/app.js')
</body>
<!-- END: Body-->

</html>
