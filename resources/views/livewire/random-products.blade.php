<?php

use App\Helpers\ProductHelper;

?>
@if(count($randomProducts) > 0)
    <div wire:ignore>
        <div wire:key="item-hot-deal-product" class="container furniture">
            <div class="heading heading-flex heading-border mb-3">
                <div class="heading-left mb-1">
                    <h2 class="title">Your desired products</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                @foreach($randomProducts as $product)
                    @php
                        $randomProductImg = $product->featured_image;
                    @endphp

                    @if($randomProductImg)
                        <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                            <div class="product product-2">
                                <figure class="product-media">
                                    @if($product->value->stock <= 0)
                                        <span
                                            class="product-label  {{ \App\Enum\LabelColor::labelColor('out') }}">
                                            {{ 'Out of Stock' }}
                                        </span>
                                    @endif
                                    @if($product->labels)
                                        @foreach($product->labels as $label)
                                            @php
                                                $labelClass = \App\Enum\LabelColor::labelColor(strtolower($label['name']));
                                            @endphp
                                            <span class="product-label label-circle {{ $labelClass }}">
                                        {{ ucfirst($label['name']) }}
                                    </span>
                                        @endforeach
                                    @endif

                                    <a href="{{ route('frontend.shop.product', $product->slug) }}">
                                        <img loading="lazy" src="{{ getImageUrl($product->featured_image) }}"
                                             style="width: 300px; height: 274px"
                                             alt="Product image" class="product-image">
                                    </a>

                                    <livewire:add-to-wishlist :product="$product" :wire:key="time().$product->id"/>

                                    <div class="product-action">
                                        <a href="{{ route('frontend.shop.product', $product->slug) }}"
                                           class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>
                                        <a href="{{ route('product.quickview', $product->slug) }}"
                                           class="btn-product btn-quickview"
                                           title="Quick view"><span>quick view</span></a>
                                    </div>
                                </figure>

                                <div class="product-body">
                                    <div class="product-cat">
                                        <a href="{{ route('frontend.shop.index', ['category' => $product->sub_category_name]) }}">
                                            {{ $product->sub_category_name }}</a>
                                    </div><!-- End .product-cat -->
                                    <h3 class="product-title"><a
                                            href="{{ route('frontend.shop.product', $product->slug) }}">
                                            {{ $product->name }}
                                        </a>
                                        @if($product->value->promo_price > 0)
                                            <span class="badge badge-warning p-2">Promo</span>
                                        @endif
                                        @if($product->condition)
                                            <br>
                                            <span class="badge badge-primary">{{ ucfirst($product->condition) }}</span>
                                        @endif
                                    </h3>
                                    <div class="product-price">
                                        @if($product->value->promo_price > 0)
                                            <div class="mr-4">
                                                <span
                                                    class="new-price">{{ formatPriceWithBdCurrency($product->value->promo_price) }}</span>
                                                <span
                                                    class="old-price">{{ formatPriceWithBdCurrency($product->value->sale_price) }}</span>
                                                <span style="font-size: 12px;">save
                                                    {{ round((($product->value->sale_price - $product->value->promo_price) / $product->value->sale_price) * 100) }}
                                                     %
                                                </span>
                                            </div>
                                        @endif

                                        @if($product->value->base_price > 0)
                                            <div>
                                                <span
                                                    class="new-price">{{ formatPriceWithBdCurrency($product->value->sale_price) }}</span>
                                                <span
                                                    class="old-price">{{ formatPriceWithBdCurrency($product->value->base_price) }}</span>
                                                <span style="font-size: 12px;">save
                                                    {{ round((($product->value->base_price - $product->value->sale_price) / $product->value->base_price) * 100) }}
                                                     %
                                                </span>
                                            </div>
                                        @endif

                                        @if($product->value->promo_price <= 0 && $product->value->base_price <= 0)
                                            <span
                                                class="new-price">{{ formatPriceWithBdCurrency($product->value->sale_price) }}</span>
                                        @endif
                                    </div><!-- End .product-price -->
                                    @php
                                        if (count($product->reviews) > 0) {
                                            $rating = $product->reviews->sum('rating') / count($product->reviews);
                                        } else {
                                            $rating = 0;
                                        }
                                    @endphp
                                    @if(count($product->reviews) > 0)
                                        <div class="ratings-container">
                                            <div class="ratings">
                                                <div class="ratings-val" style="width: {{ $rating * 20 }}%;"></div>
                                                <!-- End .ratings-val -->
                                            </div><!-- End .ratings -->
                                            <span class="ratings-text">({{ count($product->reviews) }} Reviews)</span>
                                        </div><!-- End .rating-container -->
                                    @endif
                                </div><!-- End .product-body -->
                            </div><!-- End .product -->
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="mb-3"></div>
    </div>
@endif
