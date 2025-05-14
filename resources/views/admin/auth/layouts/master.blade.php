<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <link rel="shortcut icon" href="{{ asset('admin-assets/images/logo/favicon.ico') }}">

    <title>@yield('admin-title') - {{ \App\Constants\AdminConstant::APP_NAME }}</title>
    @include('admin.auth.partials.styles')

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        @yield('admin-auth-content')
    </div>
</div>
<!-- END: Content-->
@include('admin.auth.partials.scripts')
</body>
<!-- END: Body-->

</html>
