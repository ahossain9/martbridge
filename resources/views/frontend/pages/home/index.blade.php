@extends('frontend.layouts.app')

@section('title', __('Home' . ' | ' . 'Experience the future tech shop in Bangladesh'))

@section('page-content')
    <div>
        <div class="intro-section pt-3 pb-3 mb-2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="intro-slider-container slider-container-ratio mb-2 mb-lg-0">
                            <div class="intro-slider owl-carousel owl-simple owl-dark owl-nav-inside" data-toggle="owl"
                                 data-owl-options='{
                                        "nav": false,
                                        "dots": true,
                                        "responsive": {
                                            "768": {
                                                "nav": true,
                                                "dots": false
                                            }
                                        }
                                    }'>

                                @foreach($sliders as $slider)
                                    <div class="intro-slide">
                                        <figure class="slide-image">
                                            <picture>
                                                <source media="(max-width: 480px)"
                                                        srcset="{{ \App\Helpers\FileManageHelper::getS3FileUrl($slider->image) }}">
                                                <img loading="lazy"
                                                     src="{{ \App\Helpers\FileManageHelper::getS3FileUrl($slider->image) }}"
                                                     alt="Image Desc">
                                            </picture>
                                        </figure><!-- End .slide-image -->

                                        <div class="intro-content">
                                            @if($slider->subtitle)
                                                <h3 class="intro-subtitle text-primary">Daily Deals</h3>
                                            @endif

                                            @php
                                                $words = explode(' ', $slider->title);
                                                $first_word = implode(' ', array_slice($words, 0, 2)) ?? '';
                                                $second_word = implode(' ', array_slice($words, 2)) ?? '';
                                            @endphp

                                            <h1 class="intro-title">{{ $first_word }} <br> {{ $second_word }} </h1>

                                            <div class="intro-price">
                                                    <span>
                                                        @if($slider->base_price)
                                                            <sup
                                                                class="font-weight-light line-through">{{ currency() . formatPrice($slider->base_price) }}</sup>
                                                        @else
                                                            <sup
                                                                class="font-weight-light">{{ $slider->third_ttile }}</sup>
                                                        @endif

                                                        @if($slider->discount_price)
                                                            <span
                                                                class="text-primary">{{ currency(). formatPrice($slider->discount_price) }}</span>
                                                        @endif
                                                    </span>
                                            </div>

                                            @if($slider->link_text)
                                                <a href="{{ $slider->link }}" class="btn btn-primary btn-round">
                                                    <span>{{ $slider->link_text }}</span>
                                                    <i class="icon-long-arrow-right"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <span class="slider-loader"></span>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="intro-banners">
                            @foreach($banners as $banner)
                                <div class="banner mb-lg-1 mb-xl-2">
                                    <a href="#">
                                        <img src="{{ \App\Helpers\FileManageHelper::getS3FileUrl($banner->image) }}"
                                             alt="Banner">
                                    </a>

                                    <div class="banner-content">
                                        <h4 class="banner-subtitle d-lg-none d-xl-block"><a
                                                href="#">{{ $banner->subtitle }}</a></h4>
                                        <!-- End .banner-subtitle -->
                                        <h3 class="banner-title"><a
                                                href="{{ $banner->link }}">{!! $banner->title !!}</a></h3>
                                        <!-- End .banner-title -->
                                        <a href="{{ $banner->link }}" class="banner-link">{{ $banner->link_text }}<i
                                                class="icon-long-arrow-right"></i></a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div>

        <div class="container featured">
            <ul class="nav nav-pills nav-border-anim nav-big justify-content-center mb-3" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="products-featured-link" data-toggle="tab"
                       href="#products-featured-tab" role="tab" aria-controls="products-featured-tab"
                       aria-selected="true">Featured</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="products-sale-link" data-toggle="tab" href="#products-sale-tab" role="tab"
                       aria-controls="products-sale-tab" aria-selected="false">On Sale</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="products-top-link" data-toggle="tab" href="#products-top-tab" role="tab"
                       aria-controls="products-top-tab" aria-selected="false">Top Rated</a>
                </li>
            </ul>

            <div class="tab-content tab-content-carousel">
                <div class="tab-pane p-0 fade show active" id="products-featured-tab" role="tabpanel"
                     aria-labelledby="products-featured-link">
                    <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow" data-toggle="owl"
                         data-owl-options='{
                                "nav": true,
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "responsive": {
                                    "0": {
                                        "items":2
                                    },
                                    "600": {
                                        "items":2
                                    },
                                    "992": {
                                        "items":3
                                    },
                                    "1200": {
                                        "items":4
                                    }
                                }
                            }'>

                        @foreach(\App\Helpers\ProductHelper::getFeaturedProducts() as $featPro)
                            <div class="product product-2">
                                <figure class="product-media">
                                    <a href="{{ route('frontend.shop.product', $featPro->slug) }}">
                                        <img src="{{ getImageUrl($featPro->featured_image) }}" loading="lazy"
                                             style="width: 300px; height: 274px"
                                             alt="Product image"
                                             class="product-image">
                                    </a>

                                    <livewire:add-to-wishlist :product="$featPro" :wire:key="$featPro->id"/>

                                    <div class="product-action">
                                        <a href="{{ route('frontend.shop.product', $featPro->slug) }}"
                                           class="btn-product btn-cart"
                                           title="Add to cart"><span>add to cart</span></a>
                                        <a href="{{ route('product.quickview', $featPro->slug) }}"
                                           class="btn-product btn-quickview"
                                           title="Quick view"><span>quick view</span></a>
                                    </div><!-- End .product-action -->
                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <div class="product-cat">
                                        <a href="{{ route('frontend.shop.index', ['category' => $featPro->sub_category_name]) }}">
                                            {{ $featPro->sub_category_name }}</a>
                                    </div><!-- End .product-cat -->
                                    <h3 class="product-title"><a
                                            href="{{ route('frontend.shop.product', $featPro->slug) }}">
                                            {{ $featPro->name }}
                                        </a>
                                        @if($featPro->value->promo_price > 0)
                                            <span class="badge badge-warning p-2">Promo</span>
                                        @endif
                                        @if($featPro->condition)
                                            <br>
                                            <span class="badge badge-primary">{{ ucfirst($featPro->condition) }}</span>
                                        @endif
                                    </h3>
                                    <div class="product-price">
                                        @if($featPro->value->promo_price > 0)
                                            <div class="mr-4">
                                                <span class="new-price">{{ formatPriceWithBdCurrency($featPro->value->promo_price) }}</span>
                                                <span class="old-price">{{ formatPriceWithBdCurrency($featPro->value->sale_price) }}</span>
                                                <span style="font-size: 12px;">save
                                                    {{ round((($featPro->value->sale_price - $featPro->value->promo_price) / $featPro->value->sale_price) * 100) }}
                                                     %
                                                </span>
                                            </div>
                                        @endif

                                        @if($featPro->value->base_price > 0)
                                            <div>
                                                <span class="new-price">{{ formatPriceWithBdCurrency($featPro->value->sale_price) }}</span>
                                                <span class="old-price">{{ formatPriceWithBdCurrency($featPro->value->base_price) }}</span>
                                                <span style="font-size: 12px;">save
                                                    {{ round((($featPro->value->base_price - $featPro->value->sale_price) / $featPro->value->base_price) * 100) }}
                                                     %
                                                </span>
                                            </div>
                                        @endif

                                        @if($featPro->value->promo_price <= 0 && $featPro->value->base_price <= 0)
                                            <span class="new-price">{{ formatPriceWithBdCurrency($featPro->value->sale_price) }}</span>
                                        @endif
                                    </div><!-- End .product-price -->
                                    <div class="ratings-container">
                                        @php
                                            $reviewCount = count($featPro->reviews) ?? 0;
                                        @endphp
                                        @if($reviewCount)
                                            <div class="ratings">
                                                @php
                                                    if ($reviewCount > 0) {
                                                        $rating = $featPro->reviews->sum('rating') / count($featPro->reviews);
                                                    } else {
                                                        $rating = 0;
                                                    }
                                                @endphp
                                                <div class="ratings-val" style="width: {{ $rating * 20 }}%;"></div>
                                                <!-- End .ratings-val -->
                                            </div><!-- End .ratings -->
                                            <span class="ratings-text">({{ count($featPro->reviews) }} Reviews)</span>
                                        @endif
                                    </div><!-- End .rating-container -->
                                </div><!-- End .product-body -->
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane p-0 fade" id="products-sale-tab" role="tabpanel"
                     aria-labelledby="products-sale-link">
                    <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow" data-toggle="owl"
                         data-owl-options='{
                                "nav": true,
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "responsive": {
                                    "0": {
                                        "items":2
                                    },
                                    "600": {
                                        "items":2
                                    },
                                    "992": {
                                        "items":3
                                    },
                                    "1200": {
                                        "items":4
                                    }
                                }
                            }'>
                        @foreach(\App\Helpers\ProductHelper::getOnSaleProducts() as $onSalePro)
                            <div class="product product-2">
                                <figure class="product-media">
                                    <a href="{{ route('frontend.shop.product', $onSalePro->slug) }}">
                                        <img src="{{ getImageUrl($onSalePro->featured_image) }}" loading="lazy"
                                             style="width: 300px; height: 274px"
                                             alt="Product image"
                                             class="product-image">
                                    </a>

                                    <livewire:add-to-wishlist :product="$onSalePro" :wire:key="$onSalePro->id"/>

                                    <div class="product-action">
                                        <a href="#" class="btn-product btn-cart"
                                           title="Add to cart"><span>add to cart</span></a>
                                        <a href="{{ route('product.quickview', $onSalePro->slug) }}"
                                           class="btn-product btn-quickview"
                                           title="Quick view"><span>quick view</span></a>
                                    </div><!-- End .product-action -->
                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <div class="product-cat">
                                        <a href="{{ route('frontend.shop.index', ['category' => $onSalePro->sub_category_name]) }}">
                                            {{ $onSalePro->sub_category_name }}</a>
                                    </div><!-- End .product-cat -->
                                    <h3 class="product-title"><a
                                            href="{{ route('frontend.shop.product', $onSalePro->slug) }}">
                                            {{ $onSalePro->name }}
                                        </a>
                                        @if($onSalePro->value->promo_price > 0)
                                            <span class="badge badge-warning p-2">Promo</span>
                                        @endif
                                        @if($onSalePro->condition)
                                            <br>
                                            <span class="badge badge-primary">{{ ucfirst($onSalePro->condition) }}</span>
                                        @endif
                                    </h3>
                                    <div class="product-price">
                                        @if($onSalePro->value->promo_price > 0)
                                            <div class="mr-4">
                                                <span class="new-price">{{ formatPriceWithBdCurrency($onSalePro->value->promo_price) }}</span>
                                                <span class="old-price">{{ formatPriceWithBdCurrency($onSalePro->value->sale_price) }}</span>
                                                <span style="font-size: 12px;">save
                                                    {{ round((($onSalePro->value->sale_price - $onSalePro->value->promo_price) / $onSalePro->value->sale_price) * 100) }}
                                                     %
                                                </span>
                                            </div>
                                        @endif

                                        @if($onSalePro->value->base_price > 0)
                                            <div>
                                                <span class="new-price">{{ formatPriceWithBdCurrency($onSalePro->value->sale_price) }}</span>
                                                <span class="old-price">{{ formatPriceWithBdCurrency($onSalePro->value->base_price) }}</span>
                                                <span style="font-size: 12px;">save
                                                    {{ round((($onSalePro->value->base_price - $onSalePro->value->sale_price) / $onSalePro->value->base_price) * 100) }}
                                                     %
                                                </span>
                                            </div>
                                        @endif

                                        @if($onSalePro->value->promo_price <= 0 && $onSalePro->value->base_price <= 0)
                                            <span class="new-price">{{ formatPriceWithBdCurrency($onSalePro->value->sale_price) }}</span>
                                        @endif
                                    </div>
                                    @php
                                        if (count($onSalePro->reviews) > 0) {
                                            $rating = $onSalePro->reviews->sum('rating') / count($onSalePro->reviews);
                                        } else {
                                            $rating = 0;
                                        }
                                    @endphp

                                    @if(count($onSalePro->reviews) > 0)
                                        <div class="ratings-container">
                                            <div class="ratings">
                                                <div class="ratings-val" style="width: {{ $rating * 20 }}%;"></div>
                                                <!-- End .ratings-val -->
                                            </div><!-- End .ratings -->
                                            <span class="ratings-text">({{ count($onSalePro->reviews) }} Reviews)</span>
                                        </div><!-- End .rating-container -->
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div><!-- End .owl-carousel -->
                </div>
                <div class="tab-pane p-0 fade" id="products-top-tab" role="tabpanel"
                     aria-labelledby="products-top-link">
                    <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow" data-toggle="owl"
                         data-owl-options='{
                                "nav": true,
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "responsive": {
                                    "0": {
                                        "items":2
                                    },
                                    "600": {
                                        "items":2
                                    },
                                    "992": {
                                        "items":3
                                    },
                                    "1200": {
                                        "items":4
                                    }
                                }
                            }'>
                        @foreach(\App\Helpers\ProductHelper::getTopProducts() as $topRatedPro)
                            <div class="product product-2">
                                <figure class="product-media">
                                    <a href="{{ route('frontend.shop.product', $topRatedPro->slug) }}">
                                        <img src="{{ getImageUrl($topRatedPro->featured_image) }}" loading="lazy"
                                             style="width: 300px; height: 274px"
                                             alt="Product image"
                                             class="product-image">
                                    </a>

                                    <livewire:add-to-wishlist :product="$topRatedPro" :wire:key="$topRatedPro->id"/>

                                    <div class="product-action">
                                        <a href="#" class="btn-product btn-cart"
                                           title="Add to cart"><span>add to cart</span></a>
                                        <a href="{{ route('product.quickview', $topRatedPro->slug) }}"
                                           class="btn-product btn-quickview"
                                           title="Quick view"><span>quick view</span></a>
                                    </div><!-- End .product-action -->
                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <div class="product-cat">
                                        <a href="{{ route('frontend.shop.index', ['category' => $topRatedPro->sub_category_name]) }}">
                                            {{ $topRatedPro->sub_category_name }}</a>
                                    </div><!-- End .product-cat -->
                                    <h3 class="product-title"><a
                                            href="{{ route('frontend.shop.product', $topRatedPro->slug) }}">
                                            {{ $topRatedPro->name }}
                                        </a>
                                        @if($topRatedPro->value->promo_price > 0)
                                            <span class="badge badge-warning p-2">Promo</span>
                                        @endif
                                        @if($topRatedPro->condition)
                                            <br>
                                            <span class="badge badge-primary">{{ ucfirst($topRatedPro->condition) }}</span>
                                        @endif
                                    </h3>
                                    <div class="product-price">
                                        @if($topRatedPro->value->promo_price > 0)
                                            <div class="mr-4">
                                                <span class="new-price">{{ formatPriceWithBdCurrency($topRatedPro->value->promo_price) }}</span>
                                                <span class="old-price">{{ formatPriceWithBdCurrency($topRatedPro->value->sale_price) }}</span>
                                                <span style="font-size: 12px;">save
                                                    {{ round((($topRatedPro->value->sale_price - $topRatedPro->value->promo_price) / $topRatedPro->value->sale_price) * 100) }}
                                                     %
                                                </span>
                                            </div>
                                        @endif

                                        @if($topRatedPro->value->base_price > 0)
                                            <div>
                                                <span class="new-price">{{ formatPriceWithBdCurrency($topRatedPro->value->sale_price) }}</span>
                                                <span class="old-price">{{ formatPriceWithBdCurrency($topRatedPro->value->base_price) }}</span>
                                                <span style="font-size: 12px;">save
                                                    {{ round((($topRatedPro->value->base_price - $topRatedPro->value->sale_price) / $topRatedPro->value->base_price) * 100) }}
                                                     %
                                                </span>
                                            </div>
                                        @endif

                                        @if($topRatedPro->value->promo_price <= 0 && $topRatedPro->value->base_price <= 0)
                                            <span class="new-price">{{ formatPriceWithBdCurrency($topRatedPro->value->sale_price) }}</span>
                                        @endif
                                    </div><!-- End .product-price -->
                                    @php
                                        if (count($topRatedPro->reviews) > 0) {
                                            $rating = $topRatedPro->reviews->sum('rating') / count($topRatedPro->reviews);
                                        } else {
                                            $rating = 0;
                                        }
                                    @endphp
                                    @if(count($topRatedPro->reviews) > 0)
                                        <div class="ratings-container">
                                            <div class="ratings">
                                                <div class="ratings-val" style="width: {{ $rating * 20 }}%;"></div>
                                                <!-- End .ratings-val -->
                                            </div><!-- End .ratings -->
                                            <span class="ratings-text">({{ count($topRatedPro->reviews) }} Reviews)</span>
                                        </div><!-- End .rating-container -->
                                    @endif
                                </div><!-- End .product-body -->
                            </div>
                        @endforeach
                    </div><!-- End .owl-carousel -->
                </div>
            </div><!-- End .tab-content -->
        </div>

        <div class="mb-7 mb-lg-11"></div>

        <div class="container">
            <div class="cta cta-border cta-border-image mb-5 mb-lg-7"
                 style="background-image: url({{ asset('frontend/assets/images/bg-1.jpg') }});">
                <div class="cta-border-wrapper bg-white">
                    <div class="row justify-content-center">
                        <div class="col-md-11 col-xl-11">
                            <div class="cta-content">
                                <div class="cta-heading">
                                    <h3 class="cta-title text-right"><span class="text-primary">Hot Deals</span>
                                        <br>Start your journey</h3>
                                </div><!-- End .cta-heading -->

                                <div class="cta-text">
                                    <p>Get <span class="text-dark font-weight-normal">FREE SHIPPING* & 5% rewards</span>
                                        on <br>your first order with {{ $appName }} rewards program</p>
                                </div><!-- End .cta-text -->
                                <a href="{{ route('frontend.shop.index') }}" class="btn btn-primary btn-round"><span>Shop Now</span><i
                                        class="icon-long-arrow-right"></i></a>
                            </div><!-- End .cta-content -->
                        </div><!-- End .col-xl-7 -->
                    </div><!-- End .row -->
                </div><!-- End .bg-white -->
            </div><!-- End .cta -->
        </div>


        <div class="container">
            <div class="owl-carousel mt-5 mb-5 owl-simple" data-toggle="owl"
                 data-owl-options='{
                            "nav": false,
                            "dots": false,
                            "margin": 30,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":2
                                },
                                "420": {
                                    "items":3
                                },
                                "600": {
                                    "items":4
                                },
                                "900": {
                                    "items":5
                                },
                                "1024": {
                                    "items":6
                                }
                            }
                        }'>
                @foreach(\App\Helpers\ProductHelper::getBrandsWithImage() as $brand)
                    <a href="{{ route('frontend.shop.index', ['brand' => $brand->name]) }}" class="brand">
                        <img src="{{ getImageUrl($brand->logo) }}" loading="lazy" alt="Brand Name">
                    </a>
                @endforeach
            </div><!-- End .owl-carousel -->
        </div>

        <div class="container">
            <hr class="mt-3 mb-6">
        </div>

        <livewire:trending-products :wire:key="trending_products"/>

        <div class="container">
            <hr class="mt-5 mb-6">
        </div>
        <livewire:top-selling-products :wire:key="top_selling_products"/>

        <div class="container">
            <hr class="mt-5 mb-0">
        </div>

        <div class="icon-boxes-container mt-2 mb-2 bg-transparent">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-lg-3">
                        <div class="icon-box icon-box-side">
                                <span class="icon-box-icon text-dark">
                                    <i class="icon-rocket"></i>
                                </span>
                            <div class="icon-box-content">
                                <h3 class="icon-box-title">Free Shipping</h3><!-- End .icon-box-title -->
                                <p>Orders 15,000 or more</p>
                            </div><!-- End .icon-box-content -->
                        </div><!-- End .icon-box -->
                    </div><!-- End .col-sm-6 col-lg-3 -->

                    <div class="col-sm-6 col-lg-3">
                        <div class="icon-box icon-box-side">
                                <span class="icon-box-icon text-dark">
                                    <i class="icon-rotate-left"></i>
                                </span>

                            <div class="icon-box-content">
                                <h3 class="icon-box-title">Free Returns</h3><!-- End .icon-box-title -->
                                <p>Within 10 days</p>
                            </div><!-- End .icon-box-content -->
                        </div><!-- End .icon-box -->
                    </div><!-- End .col-sm-6 col-lg-3 -->

                    <div class="col-sm-6 col-lg-3">
                        <div class="icon-box icon-box-side">
                                <span class="icon-box-icon text-dark">
                                    <i class="icon-info-circle"></i>
                                </span>

                            <div class="icon-box-content">
                                <h3 class="icon-box-title">Get 5% Off for the first order</h3>
                                <!-- End .icon-box-title -->
                                <p>when you sign up</p>
                            </div><!-- End .icon-box-content -->
                        </div><!-- End .icon-box -->
                    </div><!-- End .col-sm-6 col-lg-3 -->

                    <div class="col-sm-6 col-lg-3">
                        <div class="icon-box icon-box-side">
                                <span class="icon-box-icon text-dark">
                                    <i class="icon-life-ring"></i>
                                </span>

                            <div class="icon-box-content">
                                <h3 class="icon-box-title">We Support</h3><!-- End .icon-box-title -->
                                <p>24/7 amazing services</p>
                            </div><!-- End .icon-box-content -->
                        </div><!-- End .icon-box -->
                    </div><!-- End .col-sm-6 col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div>

        <livewire:random-products :wire:key="random-products"/>

        <div class="container">
            <div class="cta cta-separator cta-border-image cta-half mb-0"
                 style="background-image: url({{ asset('frontend/assets/images/bg-2.jpg') }});">
                <div class="cta-border-wrapper bg-white">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="cta-wrapper cta-text text-center">
                                <h3 class="cta-title">Shop Social</h3><!-- End .cta-title -->
                                <p class="cta-desc">Get connected to our social platform to receive latest updates
                                    and offers. </p><!-- End .cta-desc -->

                                <div class="social-icons social-icons-colored justify-content-center">
                                    <a href="https://www.facebook.com/techstronixshop"
                                       class="social-icon social-facebook" title="Facebook" target="_blank"><i
                                            class="icon-facebook-f"></i></a>
                                    <a href="https://www.instagram.com/techstronix"
                                       class="social-icon social-instagram" title="Instagram"
                                       target="_blank"><i class="icon-instagram"></i></a>
                                    <a href="#" class="social-icon social-youtube" title="Youtube"
                                       target="_blank"><i
                                            class="icon-youtube"></i></a>
                                </div><!-- End .soial-icons -->
                            </div><!-- End .cta-wrapper -->
                        </div><!-- End .col-lg-6 -->

                        <div class="col-lg-6">
                            <livewire:newsletter-subscriber :wire:key="newsletter-subscriber"/>
                        </div><!-- End .col-lg-6 -->
                    </div><!-- End .row -->
                </div><!-- End .bg-white -->
            </div><!-- End .cta -->
        </div>
    </div>
@endsection
