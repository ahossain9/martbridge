<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="S-Commerce admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="">
    <meta name="author" content="SoftScholar">
    <title>@yield('admin-title') | {{ \App\Constants\AdminConstant::APP_NAME }} </title>

    @include('admin.partials.styles')
    @yield('admin-styles')

</head>
@yield('print-content')
@include('admin.partials.scripts')
@yield('admin-scripts')
</body>
<!-- END: Body-->

</html>
