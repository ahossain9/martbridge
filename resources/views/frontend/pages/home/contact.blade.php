@extends('frontend.layouts.app')

@section('title', __('Contact ' . ' | ' . $appName))

@section('page-content')
    <div class="page-header text-center" style="background-image: url('{{ asset('frontend/assets/images/page-header-bg.jpg') }}')">
        <div class="container">
            <h1 class="page-title">Contact</h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Contact</li>
            </ol>
        </div>
    </nav>

    <div class="page-content">
{{--        <div id="map" class="mb-5"></div>--}}
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="contact-box text-center">
                        <h3>Office</h3>
                        <address>29/3, Shukrabad <br>Dhaka 1207, Bangladesh</address>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="contact-box text-center">
                        <h3>Start a Conversation</h3>

                        <div><a href="mailto:#">contact@techstronix.com</a></div>
                        <div><a href="tel:#">+880 1688-034-515</a></div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="contact-box text-center">
                        <h3>Social</h3>

                        <div class="social-icons social-icons-color justify-content-center">
                            <a href="https://www.facebook.com/techstronixshop" class="social-icon social-facebook" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                            <a href="#" class="social-icon social-youtube" title="Youtube" target="_blank"><i class="icon-youtube"></i></a>
                        </div><!-- End .soial-icons -->
                    </div><!-- End .contact-box -->
                </div><!-- End .col-md-4 -->
            </div><!-- End .row -->

            <hr class="mt-3 mb-5 mt-md-1">
            <div class="touch-container row justify-content-center">
                <div class="col-md-9 col-lg-7">
                    <div class="text-center">
                        <h2 class="title mb-1">Get In Touch</h2><!-- End .title mb-2 -->
                        <p class="lead text-primary">
                            We collaborate with ambitious brands and people; we’d love to build something great together.
                        </p><!-- End .lead text-primary -->
                        <p class="mb-3">Leave your message by filling up the simple form or tell us your query to our live chat.</p>
                    </div><!-- End .text-center -->

                    <form action="{{ route('frontend.contact.submit') }}" method="POST" class="contact-form mb-2 mt-4">
                        @csrf

                        @include('frontend.partials.message')
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="cname" class="sr-only">Name</label>
                                <input type="text" class="form-control" id="cname" name="name" placeholder="Name *" required>
                            </div><!-- End .col-sm-4 -->

                            <div class="col-sm-4">
                                <label for="cemail" class="sr-only">Email</label>
                                <input type="email" class="form-control" id="cemail" name="email" placeholder="Email *" required>
                            </div><!-- End .col-sm-4 -->

                            <div class="col-sm-4">
                                <label for="cphone" class="sr-only">Phone</label>
                                <input type="tel" class="form-control" id="cphone" name="phone" placeholder="Phone">
                            </div><!-- End .col-sm-4 -->
                        </div><!-- End .row -->

                        <label for="csubject" class="sr-only">Subject</label>
                        <input type="text" class="form-control" id="csubject" name="subject" placeholder="Subject">

                        <label for="cmessage" class="sr-only">Message</label>
                        <textarea class="form-control" cols="30" rows="4" id="cmessage" name="message" required placeholder="Message *"></textarea>

                        <div class="text-center">
                            <button type="submit" class="btn btn-outline-primary-2 btn-minwidth-sm">
                                <span>SUBMIT</span>
                                <i class="icon-long-arrow-right"></i>
                            </button>
                        </div><!-- End .text-center -->
                    </form><!-- End .contact-form -->
                </div><!-- End .col-md-9 col-lg-7 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->

@endsection
