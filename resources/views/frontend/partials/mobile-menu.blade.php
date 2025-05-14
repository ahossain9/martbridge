<div class="mobile-menu-overlay"></div>

<div class="mobile-menu-container">
    <div class="mobile-menu-wrapper">
        <span class="mobile-menu-close"><i class="icon-close"></i></span>

        <form action="{{ route('frontend.shop.index') }}" method="get" class="mobile-search">
            <label for="mobile-search" class="sr-only">Search</label>
            <input type="search" class="form-control" name="search-query" id="main_search" placeholder="Search query" required>
            <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
        </form>

        <ul class="nav nav-pills-mobile nav-border-anim" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="mobile-menu-link" data-toggle="tab" href="#mobile-menu-tab" role="tab" aria-controls="mobile-menu-tab" aria-selected="true">Menu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="mobile-cats-link" data-toggle="tab" href="#mobile-cats-tab" role="tab" aria-controls="mobile-cats-tab" aria-selected="false">Categories</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="mobile-menu-tab" role="tabpanel" aria-labelledby="mobile-menu-link">
                <nav class="mobile-nav">
                    <ul class="mobile-menu">
                        <li class="active">
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        <li>
                            <a href="#">Shop</a>
                            <ul>
                                <li><a href="{{ route('frontend.shop.index') }}">Products</a></li>
                                <li><a href="{{ route('frontend.products.cart') }}">Cart</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ route('frontend.contact') }}">Contact</a></li>
                    </ul>
                </nav><!-- End .mobile-nav -->
            </div><!-- .End .tab-pane -->
            <div class="tab-pane fade" id="mobile-cats-tab" role="tabpanel" aria-labelledby="mobile-cats-link">
                <nav class="mobile-cats-nav">
                    <ul class="mobile-cats-menu">
                        @foreach(\App\Helpers\ShopHelper::subcategories() as $sub)
                            <li><a class="mobile-cats-lead" href="{{ route('frontend.shop.index', ['category' => $sub->name]) }}">{{ $sub->name }}</a></li>
                        @endforeach
                    </ul><!-- End .mobile-cats-menu -->
                </nav><!-- End .mobile-cats-nav -->
            </div><!-- .End .tab-pane -->
        </div><!-- End .tab-content -->

        <div class="social-icons">
            <a href="https://www.facebook.com/techstronixshop" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
            <a href="https://www.instagram.com/techstronix" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
            <a href="#" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>
        </div> End .social-icons
    </div><!-- End .mobile-menu-wrapper -->
</div><!-- End .mobile-menu-container -->
