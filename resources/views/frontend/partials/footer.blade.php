<footer class="footer">
    <div class="footer-middle border-0">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-6">
                    <div class="widget widget-about">
                        <div class="d-flex justify-content-start">
                            <img src="{{ asset('frontend/assets/images/logo.png') }}" class="footer-logo" alt="Footer Logo" width="105"  style="height: 55px;">
                            <h3><strong>{{ $appName }}</strong></h3>
                        </div>
                        <p>{{ $appName }} is a wide range of electronic goods, from smartphones to PC components, and everything in between. We offer the latest devices and top-quality accessories to elevate your digital experience. Shop now and discover the world of endless possibilities. </p>

                        <div class="widget-about-info">
                            <div class="row">
                                <div class="col-sm-6 col-md-4">
                                    <span class="widget-about-title">Got Question? Call us 24/7</span>
                                    <a href="tel:123456789">+01688 034 515</a>
                                </div><!-- End .col-sm-6 -->
                                <div class="col-sm-6 col-md-8">
<!--                                    <span class="widget-about-title">Payment Method</span>
                                    <figure class="footer-payments">
                                        <img src="{{ asset('frontend/assets/images/payments.png') }}" alt="Payment methods" width="272" height="20">
                                    </figure>-->
                                </div>
                            </div><!-- End .row -->
                        </div><!-- End .widget-about-info -->
                    </div><!-- End .widget about-widget -->
                </div><!-- End .col-sm-12 col-lg-3 -->

                <div class="col-sm-4 col-lg-2">
                    <div class="widget">
                        <h4 class="widget-title">Information</h4>

                        <ul class="widget-list">
                            <li><a href="{{ route('frontend.about') }}">About</a></li>
                            <li><a href="{{ route('frontend.faq') }}">FAQ</a></li>
                            <li><a href="{{ route('frontend.contact') }}">Contact us</a></li>
                        </ul><!-- End .widget-list -->
                    </div><!-- End .widget -->
                </div><!-- End .col-sm-4 col-lg-3 -->

                <div class="col-sm-4 col-lg-2">
                    <div class="widget">
                        <h4 class="widget-title">Customer Service</h4><!-- End .widget-title -->

                        <ul class="widget-list">
                            <li><a href="{{ route('frontend.terms') }}">Terms and conditions</a></li>
                            <li><a href="{{ route('frontend.privacy') }}">Privacy Policy</a></li>
                            <li><a href="{{ route('frontend.contact') }}">Get in touch</a></li>
                        </ul><!-- End .widget-list -->
                    </div><!-- End .widget -->
                </div><!-- End .col-sm-4 col-lg-3 -->

                <div class="col-sm-4 col-lg-2">
                    <div class="widget">
                        <h4 class="widget-title">My Account</h4><!-- End .widget-title -->

                        <ul class="widget-list">
                            <li><a href="{{ route('frontend.auth.login') }}">Sign In</a></li>
                            <li><a href="{{ route('frontend.products.cart') }}">View Cart</a></li>
{{--                            <li><a href="#">My Wishlist</a></li>--}}
                            <li><a href="{{ route('frontend.auth.account.index') }}">Track My Order</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <p class="footer-copyright">Copyright © 2023 {{ $appName }}. A product of <a href="https://softscholar.com" target="_blank">
                    <span class="text-primary">SoftScholar</span>
                </a>.</p>
            <ul class="footer-menu">
                <li><a href="{{ route('frontend.terms') }}">Terms Of Use</a></li>
                <li><a href="{{ route('frontend.privacy') }}">Privacy Policy</a></li>
            </ul><!-- End .footer-menu -->

            <div class="social-icons social-icons-color">
                <span class="social-label"><strong>
                        Keep an eye on our Facebook Page
                    </strong></span>
                <a href="https://www.facebook.com/techstronixshop" class="social-icon social-facebook" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
<!--                <a href="#" class="social-icon social-twitter" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                <a href="#" class="social-icon social-instagram" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                <a href="#" class="social-icon social-youtube" title="Youtube" target="_blank"><i class="icon-youtube"></i></a>
                <a href="#" class="social-icon social-pinterest" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>-->
            </div><!-- End .soial-icons -->
        </div><!-- End .container -->
    </div><!-- End .footer-bottom -->
</footer>
<!-- End .footer -->
