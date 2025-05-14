@extends('frontend.layouts.app')

@section('title', __('About ' . ' | ' . $appName))

@section('page-content')
    <div class="page-header text-center" style="background-image: url('{{ asset('frontend/assets/images/page-header-bg.jpg') }}')">
        <div class="container">
            <h1 class="page-title">About Us</h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">About</li>
            </ol>
        </div>
    </nav>

    @include('admin.partials.message')
    <div class="page-content pb-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="about-text text-center mt-3">
                        <h2 class="title text-center mb-2">Who We Are</h2><!-- End .title text-center mb-2 -->
                        <p>
                            We are your ultimate destination for all things electronics. Whether you're looking for cutting-edge smartphones, high-performance PC components, or a wide variety of accessories to enhance your digital lifestyle, we have it all. Our mission is to provide you with the latest devices and top-quality accessories that will take your digital experience to new heights.
                        </p>
                        <br>
                        <p>
                            Choosing TechsTronix, you're not just purchasing products – you're opening the door to endless possibilities. We are passionate about technology and believe in empowering our customers with the tools they need to embrace the digital revolution. With our exceptional customer service, user-friendly website, secure payment options, and efficient delivery services, we strive to provide you with a seamless shopping experience.
                        </p>

                    </div><!-- End .about-text -->
                </div><!-- End .col-lg-10 offset-1 -->
            </div><!-- End .row -->
            <div class="mb-4"></div><!-- End .mb-2 -->
            <div class="row justify-content-center">
                <div class="col-lg-4 col-sm-6">
                    <div class="icon-box icon-box-sm text-center">
                                <span class="icon-box-icon">
                                    <i class="icon-puzzle-piece"></i>
                                </span>
                        <div class="icon-box-content">
                            <h3 class="icon-box-title">Product Quality</h3><!-- End .icon-box-title -->
                            <p>TechsTronix is synonymous with exceptional product quality. We meticulously select and offer only the finest electronic goods and accessories to ensure your utmost satisfaction. </p>
                        </div><!-- End .icon-box-content -->
                    </div><!-- End .icon-box -->
                </div><!-- End .col-lg-4 col-sm-6 -->

                <div class="col-lg-4 col-sm-6">
                    <div class="icon-box icon-box-sm text-center">
                                <span class="icon-box-icon">
                                    <i class="icon-life-ring"></i>
                                </span>
                        <div class="icon-box-content">
                            <h3 class="icon-box-title">Professional Support</h3><!-- End .icon-box-title -->
                            <p>our dedicated and knowledgeable customer support team is here to provide you with professional assistance, ensuring a seamless and satisfying shopping experience. </p>
                        </div><!-- End .icon-box-content -->
                    </div><!-- End .icon-box -->
                </div><!-- End .col-lg-4 col-sm-6 -->

                <div class="col-lg-4 col-sm-6">
                    <div class="icon-box icon-box-sm text-center">
                                <span class="icon-box-icon">
                                    <i class="icon-heart-o"></i>
                                </span>
                        <div class="icon-box-content">
                            <h3 class="icon-box-title">In-time Delivery</h3><!-- End .icon-box-title -->
                            <p>e understand the importance of timely delivery. That's why we offer fast and reliable shipping services, ensuring your orders reach you promptly and securely, enhancing your overall shopping experience.</p>
                        </div><!-- End .icon-box-content -->
                    </div><!-- End .icon-box -->
                </div><!-- End .col-lg-4 col-sm-6 -->
            </div><!-- End .row -->
        </div><!-- End .container -->

        <div class="mb-2"></div><!-- End .mb-2 -->


        <div class="bg-light-2 pt-6 pb-7 mb-6">
            <div class="container">
                <h2 class="title text-center mb-4"></h2><!-- End .title text-center mb-2 -->

                <div class="text-center mt-3">
                    <a href="{{ route('frontend.contact') }}" class="btn btn-sm btn-minwidth-lg btn-outline-primary-2">
                        <span>Let's Connect</span>
                        <i class="icon-long-arrow-right"></i>
                    </a>
                </div><!-- End .text-center -->
            </div><!-- End .container -->
        </div><!-- End .bg-light-2 pt-6 pb-6 -->
    </div><!-- End .page-content -->

@endsection
