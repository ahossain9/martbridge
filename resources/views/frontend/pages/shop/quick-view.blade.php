@extends('frontend.layouts.app')
@section('page-content')
    <div class="container quickView-container" >
        <div class="quickView-content">
            <div class="row">
                <div class="col-lg-7 col-md-6">
                    <div class="row">
                        <div class="product-left">
                            <a href="#product-featured"
                               class="carousel-dot active">
                                <img src="{{ getImageUrl($product->featured_image) }}">
                            </a>

                            @foreach($product->galleries as $gallery)
                                <a href="#product-{{ $gallery->images->id }}"
                                   class="carousel-dot">
                                    <img src="{{ getImageUrl($gallery->images->large_image) }}">
                                </a>
                            @endforeach
                        </div>
                        <div class="product-right">
                            <div class="owl-carousel owl-theme owl-nav-inside owl-light mb-0" data-toggle="owl"
                                 data-owl-options='{
	                        "dots": false,
	                        "nav": false,
	                        "URLhashListener": true,
	                        "responsive": {
	                            "900": {
	                                "nav": true,
	                                "dots": true
	                            }
	                        }
	                    }'>
                                <div class="intro-slide" data-hash="product-featured">
                                    <img src="{{ getImageUrl($product->featured_image) }}" alt="Image Desc">
{{--                                    <a href="{{ getImageUrl($product->featured_image) }}" class="btn-fullscreen">--}}
{{--                                        <i class="icon-arrows"></i>--}}
{{--                                    </a>--}}
                                </div>

                                @foreach($product->galleries as $gallery)
                                    <div class="intro-slide" data-hash="product-{{ $gallery->images->id }}">
                                        <img src="{{ getImageUrl($gallery->images->large_image) }}" alt="Image Desc">
{{--                                        <a href="{{ getImageUrl($gallery->images->large_image) }}"--}}
{{--                                           class="btn-fullscreen">--}}
{{--                                            <i class="icon-arrows"></i>--}}
{{--                                        </a>--}}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6">
                    <div>
                        <h1 class="product-title">{{ $product->name }}</h1>
                        @if($product->value->promo_price > 0)
                            <span class="badge badge-warning p-2">Promo Applied</span>
                        @endif
                    </div>

                    <div class="d-inline-flex">
                        <label class="font-weight-bold">Brand:</label>
                        <a href="#" class="ml-2">{{ $product->brand_name }}</a>
                    </div>

                    <div class="d-inline-flex">
                        <label class="font-weight-bold">Sold By:</label>
                        <a href="#" class="ml-2">{{ $product->vendor->name }}</a>
                    </div>

                    <div class="ratings-container">
                        @php
                            if (count($product->reviews) > 0)
                                $rating = $product->reviews->sum('rating') / count($product->reviews);
                            else
                                $rating = 0;
                        @endphp

                        <div class="ratings">
                            <div class="ratings-val" style="width: {{ $rating * 20 }}%;"></div>
                        </div><!-- End .ratings -->
                        <a class="ratings-text" href="#product-review-link"
                           id="review-link">({{ count($product->reviews) }}
                            Reviews )</a>
                    </div><!-- End .rating-container -->

                    <div class="product-price" style="font-size: 1.5rem">
                        @if($product->value->promo_price > 0)
                            <div class="mr-4">
                                <span class="new-price">{{ formatPriceWithBdCurrency($product->value->promo_price) }}</span>
                                <span class="old-price">{{ formatPriceWithBdCurrency($product->value->sale_price) }}</span>
                            </div>
                        @endif

                        @if($product->value->base_price > 0)
                            <div>
                                <span class="new-price">{{ formatPriceWithBdCurrency($product->value->sale_price) }}</span>
                                <span class="old-price">{{ formatPriceWithBdCurrency($product->value->base_price) }}</span>
                            </div>
                        @endif

                        @if($product->value->promo_price <= 0 && $product->value->base_price <= 0)
                            <span class="new-price">{{ formatPriceWithBdCurrency($product->value->sale_price) }}</span>
                        @endif
                    </div>

                    @if($product->value->promo_price > 0 || $product->value->base_price > 0)
                        <div class="d-inline-flex mt-1">
                            <label class="">
                                @php
                                    $discount = $product->value->promo_price ? $product->value->sale_price - $product->value->promo_price
                                     : $product->value->base_price - $product->value->sale_price;
                                    $discount = $discount > 0 ? $discount : 0;

                                    $discountPercentage = $product->value->promo_price ? ($discount * 100) / $product->value->sale_price
                                     : ($discount * 100) / $product->value->base_price;
                                @endphp
                                <div class="text-primary">
                                    You save <span class="font-weight-bold">
                                    {{ formatPriceWithBdCurrency($discount) }} ({{ round($discountPercentage) }}%)
                                </span>
                                </div>
                            </label>
                        </div>
                    @endif

                    @if($product->short_description)
                        <div class="product-content">
                            <p>{{ $product->short_description }}.</p>
                        </div>
                    @endif

                    <div class="product-details-action">
                        <a href="{{ route('frontend.shop.product', $product->slug) }}" class="btn-product btn-cart"><span>add to cart</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
