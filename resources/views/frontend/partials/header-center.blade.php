<div class="header-center">
    <nav class="main-nav">
        <ul class="menu">
            <li class="megamenu-container {{ Route::is('frontend.dashboard') ? 'active' : '' }}">
                <a href="{{ route('frontend.dashboard') }}" >Home</a>
            </li>
            <li class="{{ Route::is('frontend.shop.index') ? 'active' : '' }}">
                <a href="{{ route('frontend.shop.index') }}" class="sf-with-ul">Shop</a>
                <div class="megamenu megamenu-md">
                    <div class="row no-gutters">
                        <div class="col-md-8">
                            <div class="menu-col">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="menu-title">Shop by brand</div>
                                        <!-- End .menu-title -->
                                        <ul>
                                            @foreach(\App\Helpers\ProductHelper::brandsWithCount() as $brand)
                                                <li>
                                                    <a href="{{ route('frontend.shop.index', ['brand' => $brand->name]) }}">{{ $brand->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div><!-- End .col-md-6 -->

                                    <div class="col-md-6">
                                        <div class="menu-title">Product Category</div>
                                        <ul>
                                            @foreach(\App\Helpers\ProductHelper::getSubcategoryByAlphabet() as $subCat)
                                                <li>
                                                    <a href="{{ route('frontend.shop.index', ['category' => $subCat->name]) }}">{{ $subCat->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="menu-title">Shop Pages</div><!-- End .menu-title -->
                                        <ul>
                                            <li><a href="{{ route('frontend.products.cart') }}">Cart</a></li>
                                            <li><a href="{{ route('frontend.products.checkout') }}">Checkout</a></li>
                                            {{--                                                            <li><a href="wishlist.html">Wishlist</a></li>--}}
                                            <li><a href="{{ route('frontend.auth.account.index') }}">My Account</a></li>
                                        </ul>
                                    </div><!-- End .col-md-6 -->
                                </div><!-- End .row -->
                            </div><!-- End .menu-col -->
                        </div><!-- End .col-md-8 -->
                    </div><!-- End .row -->
                </div><!-- End .megamenu megamenu-md -->
            </li>
            <li>
                <a href="{{ route('frontend.shop.index') }}">Products</a>
            </li>
            <li class="{{ Route::is('frontend.faq') ? 'active' : '' }}"><a href="{{ route('frontend.faq') }}">FAQ</a></li>
            <li class="{{ Route::is('frontend.contact') ? 'active' : '' }}"><a href="{{ route('frontend.contact') }}">Contact</a></li>
        </ul><!-- End .menu -->
    </nav><!-- End .main-nav -->
</div>
