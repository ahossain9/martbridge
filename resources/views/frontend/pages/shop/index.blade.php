@extends('frontend.layouts.app')

@section('title', __('Shop ' . ' | ' . $appName))

@section('page-content')
    <div class="page-header text-center" style="background-image: url('{{ asset('frontend/assets/images/page-header-bg.jpg') }}')">
        <div class="container">
            <h1 class="page-title">Product Shop<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Products</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    @livewire('products-shop')
@endsection

@section('scripts')
    <script src="{{ asset('frontend/assets/js/nouislider.min.js') }}"></script>
    <script>
        $('input[type=checkbox]').on('change', function(e) {
            $('input[type=checkbox]').not(this).prop('checked', false);
        });
    </script>
@endsection
