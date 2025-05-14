@extends('frontend.layouts.app')

@section('title', 'Login')

@section('page-content')
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Login</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="login-page ">
        <div class="container">
            <div class="form-box" style="background-color: aliceblue">
                <div class="form-tab">
                    <ul class="nav nav-pills nav-fill" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin" role="tab" aria-controls="signin" aria-selected="false">Sign In</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="true">Register</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        @include('admin.partials.message')
                        <div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="signin-tab">
                            <form action="{{ route('frontend.auth.login.submit') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="email">Email address *</label>
                                    <input type="text" class="form-control" id="email" name="email" required>
                                </div><!-- End .form-group -->

                                <div class="form-group">
                                    <label for="password">Password *</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div><!-- End .form-group -->

                                <div class="form-footer">
                                    <button type="submit" class="btn btn-outline-primary-2">
                                        <span>LOG IN</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>

                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="signin-remember-2">
                                        <label class="custom-control-label" for="signin-remember-2">Remember Me</label>
                                    </div><!-- End .custom-checkbox -->

                                    <a href="#" class="forgot-link">Forgot Your Password?</a>
                                </div><!-- End .form-footer -->
                            </form>
{{--                            <div class="form-choice">--}}
{{--                                <p class="text-center">or sign in with</p>--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-sm-6">--}}
{{--                                        <a href="#" class="btn btn-login btn-g">--}}
{{--                                            <i class="icon-google"></i>--}}
{{--                                            Login With Google--}}
{{--                                        </a>--}}
{{--                                    </div><!-- End .col-6 -->--}}
{{--                                    <div class="col-sm-6">--}}
{{--                                        <a href="#" class="btn btn-login btn-f">--}}
{{--                                            <i class="icon-facebook-f"></i>--}}
{{--                                            Login With Facebook--}}
{{--                                        </a>--}}
{{--                                    </div><!-- End .col-6 -->--}}
{{--                                </div><!-- End .row -->--}}
{{--                            </div>--}}
                        </div><!-- .End .tab-pane -->
                        <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                            <form action="{{ route('frontend.auth.register.submit') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name *</label>
                                    <input type="text" class="form-control" id="name" name="first_name" required>
                                </div>

                                <div class="form-group">
                                    <label for="email">Your email address *</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>

                                <div class="form-group">
                                    <label for="password">Password *</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>

                                <div class="form-footer">
                                    <button type="submit" class="btn btn-outline-primary-2">
                                        <span>SIGN UP</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>

                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="register-policy-2" required>
                                        <label class="custom-control-label" for="register-policy-2">I agree to the
                                            <a href="{{ route('frontend.privacy') }}" target="_blank">privacy policy</a> *</label>
                                    </div><!-- End .custom-checkbox -->
                                </div><!-- End .form-footer -->
                            </form>
{{--                            <div class="form-choice">--}}
{{--                                <p class="text-center">or sign in with</p>--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-sm-6">--}}
{{--                                        <a href="#" class="btn btn-login btn-g">--}}
{{--                                            <i class="icon-google"></i>--}}
{{--                                            Login With Google--}}
{{--                                        </a>--}}
{{--                                    </div><!-- End .col-6 -->--}}
{{--                                    <div class="col-sm-6">--}}
{{--                                        <a href="#" class="btn btn-login  btn-f">--}}
{{--                                            <i class="icon-facebook-f"></i>--}}
{{--                                            Login With Facebook--}}
{{--                                        </a>--}}
{{--                                    </div><!-- End .col-6 -->--}}
{{--                                </div><!-- End .row -->--}}
{{--                            </div>--}}
                    </div><!-- End .tab-content -->
                </div><!-- End .form-tab -->
            </div><!-- End .form-box -->
        </div><!-- End .container -->
    </div><!-- End .login-page section-bg -->
@endsection
