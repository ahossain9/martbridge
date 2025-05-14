<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        @hasSection('title')
            @yield('title')
        @else
            {{ $appName }}
        @endif
    </title>
    <!-- Favicon -->
    @include('frontend.partials.metas')
    @include('frontend.partials.styles')
    @yield('styles')
    @livewireStyles
</head>

<body>
<div class="page-wrapper">
    <header class="header header-intro-clearance header-3">
        @include('frontend.partials.header-top')

        @include('frontend.partials.header-middle')

        <div class="header-bottom sticky-header">
            <div class="container">
                @include('frontend.partials.header-left')

                @include('frontend.partials.header-center')

                @include('frontend.partials.header-right')
            </div>
        </div>
    </header>

    <main class="main">
        @yield('page-content')
    </main>

    @include('frontend.partials.footer')
</div>


<button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

@include('frontend.partials.mobile-menu')

@include('frontend.partials.auth-form')

{{--@include('frontend.partials.newsletter-popup')--}}
<!-- Plugins JS File -->
@include('frontend.partials.scripts')
@livewireScripts
@yield('scripts')

</body>
</html>
