@extends('frontend.layouts.app')

@section('title', __( $product->name.','. $product->slug . ' | ' . $appName))

@section('meta_keywords', $product->name)
@section('meta_description', strip_tags($product->description))

@section('styles')
    <style>
        .small-button {
            display: inline-block;
            padding: 0.5rem 1rem;
            font-size: 1.2rem;
            font-weight: 400;
            line-height: 1.5;
            text-align: center;
            margin-right: 5px;
            text-decoration: none;
            vertical-align: middle;
            cursor: pointer;
            border: 1px solid #ced4da;
            border-radius: 0.2rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out;
            width: 100%;
        }

        .small-button:hover {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }

        .small-button.active {
            color: #fff;
            background-color: #007bff;
            border-color: #007bff;
        }

    </style>
@endsection

@section('page-content')
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container d-flex align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">{{ $product->category_name }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
            </ol>

            <nav class="product-pager ml-auto" aria-label="Product">
                <a class="product-pager-link product-pager-prev" href="#" aria-label="Previous" tabindex="-1">
                    <i class="icon-angle-left"></i>
                    <span>Prev</span>
                </a>

                <a class="product-pager-link product-pager-next" href="#" aria-label="Next" tabindex="-1">
                    <span>Next</span>
                    <i class="icon-angle-right"></i>
                </a>
            </nav><!-- End .pager-nav -->
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="row">
                @livewire('product-page', ['product' => $product])

                <aside class="col-lg-3">
                    <div class="sidebar sidebar-product">
                        <div class="widget widget-products">
                            <h4 class="widget-title">Related Product</h4><!-- End .widget-title -->

                            <div class="products">
                                @foreach($relatedProducts as $relatedProduct)
                                    @php $relatedProductImg = $relatedProduct->featured_image; @endphp
                                    @if($relatedProductImg)
                                        <div class="product product-sm">
                                            <figure class="product-media">
                                                <a href="{{ route('frontend.shop.product', $relatedProduct->slug) }}">
                                                    <img src="{{ getImageUrl($relatedProductImg) }}" alt="Product image"
                                                         class="product-image">
                                                </a>
                                            </figure>

                                            <div class="product-body">
                                                <h5 class="product-title"><a
                                                        href="{{ route('frontend.shop.product', $relatedProduct->slug) }}">{{ $relatedProduct->name }}</a>
                                                </h5>
                                                <div class="product-price">
                                                    @if($relatedProduct->value->promo_price > 0)
                                                        <div class="mr-4">
                                                <span
                                                    class="new-price">{{ formatPriceWithBdCurrency($relatedProduct->value->promo_price) }}</span>
                                                            <span
                                                                class="old-price">{{ formatPriceWithBdCurrency($relatedProduct->value->sale_price) }}</span>
                                                        </div>
                                                    @endif

                                                    @if($relatedProduct->value->base_price > 0)
                                                        <div>
                                                <span
                                                    class="new-price">{{ formatPriceWithBdCurrency($relatedProduct->value->sale_price) }}</span>
                                                            <span
                                                                class="old-price">{{ formatPriceWithBdCurrency($relatedProduct->value->base_price) }}</span>
                                                        </div>
                                                    @endif

                                                    @if($relatedProduct->value->promo_price <= 0 && $relatedProduct->value->base_price <= 0)
                                                        <span
                                                            class="new-price">{{ formatPriceWithBdCurrency($relatedProduct->value->sale_price) }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach

                            </div><!-- End .products -->

                            <a href="{{ route('frontend.shop.index') }}" class="btn btn-outline-dark-3"><span>View More Products</span><i
                                    class="icon-long-arrow-right"></i></a>
                        </div><!-- End .widget widget-products -->

                    </div>
                </aside>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h2 class="title text-center mb-4">You May Also Like</h2>
                    <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                         data-owl-options='{
                                    "nav": false,
                                    "dots": true,
                                    "margin": 20,
                                    "loop": false,
                                    "responsive": {
                                        "0": {
                                            "items":1
                                        },
                                        "480": {
                                            "items":2
                                        },
                                        "768": {
                                            "items":3
                                        },
                                        "992": {
                                            "items":4
                                        },
                                        "1200": {
                                            "items":4,
                                            "nav": true,
                                            "dots": false
                                        }
                                    }
                                }'>
                        @foreach($randomProducts as $randomProduct)
                            @php
                                $randomProductImg = $randomProduct->featured_image;
                            @endphp
                            @if($randomProductImg)
                                <div class="product product-2">
                                    <figure class="product-media">
                                        @if($randomProduct->value->stock <= 0)
                                            <span
                                                class="product-label  {{ \App\Enum\LabelColor::labelColor('out') }}">
                                            {{ 'Out of Stock' }}
                                        </span>
                                        @endif
                                        @if($randomProduct->labels)
                                            @foreach($randomProduct->labels as $label)
                                                @php
                                                    $labelClass = \App\Enum\LabelColor::labelColor($label['name']);
                                                @endphp
                                                <span class="product-label label-circle {{ $labelClass }}">
                                        {{ ucfirst($label['name']) }}
                                    </span>
                                            @endforeach
                                        @endif
                                        <a href="{{ route('frontend.shop.product', $randomProduct->slug) }}">
                                            <img loading="lazy" src="{{ getImageUrl($randomProduct->featured_image) }}"
                                                 style="width: 274px; height: 274px"
                                                 alt="Product image" class="product-image">
                                        </a>

                                        <livewire:add-to-wishlist :product="$randomProduct"
                                                                  :wire:key="time().$randomProduct->id"/>

                                        <div class="product-action">
                                            <a href="{{ route('frontend.shop.product', $randomProduct->slug) }}"
                                               class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>
                                            <a href="{{ route('product.quickview', $randomProduct->slug) }}"
                                               class="btn-product btn-quickview"
                                               title="Quick view"><span>quick view</span></a>
                                        </div><!-- End .product-action -->
                                    </figure><!-- End .product-media -->

                                    <div class="product-body">
                                        <div class="product-cat">
                                            <a href="#">{{ $randomProduct->sub_category_name }}</a>
                                        </div><!-- End .product-cat -->
                                        <h3 class="product-title"><a
                                                href="{{ route('frontend.shop.product', $randomProduct->slug) }}">{{ $randomProduct->name }}</a>
                                            @if($randomProduct->value->promo_price > 0)
                                                <span class="badge badge-warning p-2">Promo</span>
                                            @endif
                                            @if($randomProduct->condition)
                                                <br>
                                                <span class="badge badge-primary">{{ ucfirst($randomProduct->condition) }}</span>
                                            @endif
                                        </h3>
                                        <div class="product-price">
                                            @if($randomProduct->value->promo_price > 0)
                                                <div class="mr-4">
                                                <span
                                                    class="new-price">{{ formatPriceWithBdCurrency($randomProduct->value->promo_price) }}</span>
                                                    <span
                                                        class="old-price">{{ formatPriceWithBdCurrency($randomProduct->value->sale_price) }}</span>
                                                    <span style="font-size: 12px;">save
                                                    {{ round((($randomProduct->value->sale_price - $randomProduct->value->promo_price) / $randomProduct->value->sale_price) * 100) }}
                                                     %
                                                </span>
                                                </div>
                                            @endif

                                            @if($randomProduct->value->base_price > 0)
                                                <div>
                                                <span
                                                    class="new-price">{{ formatPriceWithBdCurrency($randomProduct->value->sale_price) }}</span>
                                                    <span
                                                        class="old-price">{{ formatPriceWithBdCurrency($randomProduct->value->base_price) }}</span>
                                                    <span style="font-size: 12px;">save
                                                    {{ round((($randomProduct->value->base_price - $randomProduct->value->sale_price) / $randomProduct->value->base_price) * 100) }}
                                                     %
                                                </span>
                                                </div>
                                            @endif

                                            @if($randomProduct->value->promo_price <= 0 && $randomProduct->value->base_price <= 0)
                                                <span
                                                    class="new-price">{{ formatPriceWithBdCurrency($randomProduct->value->sale_price) }}</span>
                                            @endif
                                        </div><!-- End .product-price -->
                                        @php
                                            if (count($randomProduct->reviews) > 0)
                                                $rating = $randomProduct->reviews->sum('rating') / count($randomProduct->reviews);
                                            else
                                                $rating = 0;
                                        @endphp
                                        @if(count($randomProduct->reviews) > 0)
                                            <div class="ratings-container">
                                                <div class="ratings">
                                                    <div class="ratings-val" style="width: {{ $rating * 20 }}%;"></div>
                                                    <span class="ratings-text">( {{ count($randomProduct->reviews) }} Reviews )</span>
                                                </div><!-- End .rating-container -->
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div><!-- End .container -->
    </div><!-- End .page-content -->

@endsection

@section('scripts')
    <script src="{{ asset('frontend/assets/js/jquery.elevateZoom.min.js') }}"></script>

@endsection

@section('og_meta_title', $product->name)
@section('og_meta_description', strip_tags($product->description))
@section('og_meta_image', getImageUrl($product->featured_image))
@section('og_meta_image_title', $product->name)
