@php
    use Illuminate\Support\Facades\Route;
    use App\Helpers\ShopHelper;
@endphp

<div class="header-bottom sticky-header">
    <div class="container">
        <div class="header-left">
            <div class="dropdown category-dropdown show is-on" data-visible="true">
                <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" data-display="static" title="Browse Categories">
                    Browse Categories
                </a>

                <div class="dropdown-menu {{ Route::is('frontend.dashboard') ? 'show' : '' }}">
                    <nav class="side-nav">
                        <ul class="menu-vertical sf-arrows">
                            @foreach(ShopHelper::categories() as $category)
                                <li class="megamenu-container">
                                    <a class="sf-with-ul" href="#">{{ $category->name }}</a>
                                    <div class="megamenu">
                                        <div class="row no-gutters">
                                            <div class="col-md-5">
                                                <div class="menu-col">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <ul>
                                                                @foreach($category->productSubCategories as $sub_category)
                                                                    <li><a href="{{ route('frontend.shop.index', ['category' => $sub_category->name]) }}">{{ $sub_category->name }}</a></li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div><!-- End .row -->
                                                </div><!-- End .menu-col -->
                                            </div><!-- End .col-md-8 -->

                                        </div><!-- End .row -->
                                    </div><!-- End .megamenu -->
                                </li>
                            @endforeach
                        </ul><!-- End .menu-vertical -->
                    </nav><!-- End .side-nav -->
                </div><!-- End .dropdown-menu -->
            </div><!-- End .category-dropdown -->
        </div><!-- End .col-lg-3 -->
        <div class="header-center">
            <nav class="main-nav">
                <ul class="menu sf-arrows">
                    <li class="{{ Route::is('frontend.dashboard') ? 'active' : '' }}">
                        <a href="{{ url('/') }}" >Home</a>
                    </li>
                    <li class="{{ Route::is('frontend.shop.index') ? 'active' : '' }}">
                        <a href="{{ route('frontend.shop.index') }}">Shop</a>
                    </li>
                   <li class="{{ Route::is('frontend.products.cart') ? 'active' : '' }}">
                       <a href="{{ route('frontend.products.cart') }}">Cart</a></li>
                   <li class="{{ Route::is('frontend.faq') ? 'active' : '' }}">
                       <a href="{{ route('frontend.faq') }}">Faq</a></li>
                   <li class="{{ Route::is('frontend.contact') ? 'active' : '' }}">
                       <a href="{{ route('frontend.contact') }}">Contact</a></li>
                </ul>
            </nav>
        </div>
        <div class="header-right">
            <i class="la la-lightbulb-o"></i><p><span>Get Up to 10% Off</span></p>
        </div>
    </div><!-- End .container -->
</div>
<!-- End .header-bottom -->
