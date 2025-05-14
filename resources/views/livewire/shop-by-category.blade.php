<?php

use App\Helpers\ProductHelper;

?>

<div wire:ignore>
    @foreach($sub_categories as $sub_category)
        <div wire:key="item-{{$sub_category->name}}" class="container furniture">
            <div class="heading heading-flex heading-border mb-3">
                <div class="heading-left">
                    <h2 class="title">{{ $sub_category->name }}</h2>
                </div>

                <div class="heading-right">
                    <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="furn-new-link" data-toggle="tab"
                               href="#{{ $sub_category->name }}-new-tab" role="tab"
                               aria-controls="{{ $sub_category->name }}-new-tab" aria-selected="true">New</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="tab-content tab-content-carousel">
                <div class="tab-pane p-0 fade show active" id="{{ $sub_category->name }}-new-tab" role="tabpanel"
                     aria-labelledby="furn-new-link">
                    <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                         data-owl-options='{
                                "nav": false,
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "responsive": {
                                    "0": {
                                        "items":2
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
                                    "1280": {
                                        "items":5,
                                        "nav": true
                                    }
                                }
                            }'>
                        @foreach(ProductHelper::getProductsBySubCategoryDesc($sub_category->id) as $product)
                            @php
                                $catProductImg = $product->galleries?->first()?->images?->large_image;
                            @endphp

                            @if($catProductImg)
                                <div class="product" wire:key="product-view-{{$product->slug}}">
                                    <figure class="product-media">
                                     <span
                                         class="product-label {{ $product->value->stock <= 0 ? 'label-out' : 'label-new' }}">
                                         {{ $product->value->stock <= 0 ? 'Out of Stock' : ucfirst($product->label) }}
                                     </span>
                                        <a href="{{ route('frontend.shop.product', $product->slug) }}">
                                            <img loading="lazy" src="{{ getImageUrl($catProductImg) ?? '' }}"
                                                 alt="Product image" class="product-image" width="280"
                                                 style="height: 220px!important;">
                                        </a>

                                        <!--                                    <div class="product-action-vertical">
                                                                                <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                                                            </div>-->

                                        <div class="product-action">
                                            <div class="product-action">
                                                <button
                                                    wire:click="addItemToCart({{ $product->id }})"
                                                    type="submit" class="btn-product btn-cart"
                                                    {{ $product->value->stock <=0 ? 'disabled' : '' }}
                                                    @if($product->value->stock <=0)
                                                        style="opacity: 0.2"
                                                    @endif
                                                >
                                                    <span>add to cart</span>
                                                </button>
                                            </div>
                                        </div>
                                    </figure>

                                    <div class="product-body">
                                        <div class="product-cat">
                                            <a href="#">{{ $sub_category->product_category->name }}</a>
                                        </div><!-- End .product-cat -->
                                        <h3 class="product-title">
                                            <a href="{{ route('frontend.shop.product', $product->slug) }}">
                                                {{ $product->name }}
                                            </a>
                                        </h3>
                                        <div class="product-price">
                                            <span
                                                class="new-price">{{ formatPriceWithBdCurrency($product->value?->sale_price ?? 0) }}</span>
                                            @if($product->value?->base_price)
                                                <span
                                                    class="old-price">{{ formatPriceWithBdCurrency($product->value->base_price) }}</span>
                                            @endif
                                        </div>
                                        <div class="ratings-container">
                                            <div class="ratings">
                                                <div class="ratings-val" style="width: 80%;"></div>
                                            </div>
                                            {{--                                        <span class="ratings-text">( 12 Reviews )</span>--}}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-3"></div>
    @endforeach
</div>
