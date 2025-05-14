<!-- Favicon -->
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('frontend/assets/images/icons/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('frontend/assets/images/icons/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('frontend/assets/images/icons/favicon-16x16.png') }}">
<link rel="manifest" href="{{ asset('frontend/assets/images/icons/site.html') }}">
<link rel="shortcut icon" href="{{ asset('frontend/assets/images/icons/favicon.ico') }}">
<meta name="apple-mobile-web-app-title" content="{{ $appName }}">
<meta name="application-name" content="{{ $appName }}">
<meta name="msapplication-TileColor" content="#cc9966">
<meta name="theme-color" content="#ffffff">

<meta name="keywords" content="@yield('meta_keywords', 'TechsTronix, ecommerce, tech company, electronic device')">
<meta name="description" content="@yield('meta_description', 'Wide range of electronic goods, from smartphones to PC components, and everything in between')">
<meta name="author" content="techstronix, softscholar">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="canonical" href="{{ url()->current() }}"/>

<!-- og mete content-->
<meta property="og:title" content="@yield('og_meta_title', $appName)"/>
<meta property="og:description" content="@yield('og_meta_description', 'Wide range of electronic goods, from smartphones to PC components, and everything in between')"/>
<meta property="og:image" content="@yield('og_meta_image', asset('frontend/assets/images/logo.png'))"/>
<meta property="og:url" content="{{ url()->current() }}"/>
<meta property="og:site_name" content="{{ $appName }}"/>
<meta property="og:type" content="website"/>
<meta property="og:locale" content="en_US"/>
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="@yield('og_meta_image_title', $appName)"/>

