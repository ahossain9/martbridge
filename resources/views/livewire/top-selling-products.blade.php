<div class="container top">
    <div class="heading heading-flex mb-3">
        <div class="heading-left">
            <h2 class="title">Top Selling Products</h2><!-- End .title -->
        </div><!-- End .heading-left -->

        <div class="heading-right">
            <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="top-all-link" data-toggle="tab" href="#top-all-tab"
                       role="tab" aria-controls="top-all-tab" aria-selected="true">All</a>
                </li>

                @foreach($topSaleSubCategories as $topSaleSubCat)
                    <li class="nav-item">
                        <a class="nav-link"
                           id="top-sale-{{ strtolower(str_replace(' ', '-', $topSaleSubCat->name)) }}-link"
                           data-toggle="tab"
                           href="#top-sale-{{ strtolower(str_replace(' ', '-', $topSaleSubCat->name)) }}-tab"
                           role="tab" aria-controls="top-sale-tv-tab"
                           aria-selected="false">{{ $topSaleSubCat->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div><!-- End .heading-right -->
    </div><!-- End .heading -->

    <div class="tab-content tab-content-carousel just-action-icons-sm">
        <div class="tab-pane p-0 fade show active" id="top-all-tab" role="tabpanel"
             aria-labelledby="top-all-link">
            <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow" data-toggle="owl"
                 data-owl-options='{
                                "nav": true,
                                "dots": false,
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
                                    "1200": {
                                        "items":5
                                    }
                                }
                            }'>

                @foreach($topSaleProducts as $topSaleProduct)
                    <div class="product product-2">
                        <figure class="product-media">
                            @if($topSaleProduct->value->stock <= 0)
                                <span
                                    class="product-label  {{ \App\Enum\LabelColor::labelColor('out') }}">
                                            {{ 'Out of Stock' }}
                                        </span>
                            @endif
                            @if($topSaleProduct->labels)
                                @foreach($topSaleProduct->labels as $label)
                                    @php
                                        $labelClass = \App\Enum\LabelColor::labelColor(strtolower($label['name']));
                                    @endphp
                                    <span class="product-label label-circle {{ $labelClass }}">
                                        {{ ucfirst($label['name']) }}
                                    </span>
                                @endforeach
                            @endif
                            <a href="{{ route('frontend.shop.product', $topSaleProduct->slug) }}">
                                <img loading="lazy" src="{{ getImageUrl($topSaleProduct->featured_image) }}"
                                     style="width: 300px; height: 274px"
                                     alt="Product image" class="product-image">
                            </a>

                            <livewire:add-to-wishlist :product="$topSaleProduct"
                                                      :wire:key="time().$topSaleProduct->id"/>

                            <div class="product-action">
                                <a href="{{ route('frontend.shop.product', $topSaleProduct->slug) }}"
                                   class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>
                                <a href="{{ route('product.quickview', $topSaleProduct->slug) }}"
                                   class="btn-product btn-quickview"
                                   title="Quick view"><span>quick view</span></a>
                            </div><!-- End .product-action -->
                        </figure><!-- End .product-media -->

                        <div class="product-body">
                            <div class="product-cat">
                                <a href="{{ route('frontend.shop.index', ['category' => $topSaleProduct->sub_category_name]) }}">
                                    {{ $topSaleProduct->sub_category_name }}</a>
                            </div><!-- End .product-cat -->
                            <h3 class="product-title"><a
                                    href="{{ route('frontend.shop.product', $topSaleProduct->slug) }}">
                                    {{ $topSaleProduct->name }}
                                </a>
                                @if($topSaleProduct->value->promo_price > 0)
                                    <span class="badge badge-warning p-2">Promo</span>
                                @endif
                                @if($topSaleProduct->condition)
                                    <br>
                                    <span class="badge badge-primary">{{ ucfirst($topSaleProduct->condition) }}</span>
                                @endif
                            </h3>
                            <div class="product-price">
                                @if($topSaleProduct->value->promo_price > 0)
                                    <div class="mr-4">
                                        <span
                                            class="new-price">{{ formatPriceWithBdCurrency($topSaleProduct->value->promo_price) }}</span>
                                        <span
                                            class="old-price">{{ formatPriceWithBdCurrency($topSaleProduct->value->sale_price) }}</span>
                                        <span style="font-size: 12px;">save
                                                    {{ round((($topSaleProduct->value->sale_price - $topSaleProduct->value->promo_price) / $topSaleProduct->value->sale_price) * 100) }}
                                                     %
                                                </span>
                                    </div>
                                @endif

                                @if($topSaleProduct->value->base_price > 0)
                                    <div>
                                        <span
                                            class="new-price">{{ formatPriceWithBdCurrency($topSaleProduct->value->sale_price) }}</span>
                                        <span
                                            class="old-price">{{ formatPriceWithBdCurrency($topSaleProduct->value->base_price) }}</span>
                                        <span style="font-size: 12px;">save
                                                    {{ round((($topSaleProduct->value->base_price - $topSaleProduct->value->sale_price) / $topSaleProduct->value->base_price) * 100) }}
                                                     %
                                                </span>
                                    </div>
                                @endif

                                @if($topSaleProduct->value->promo_price <= 0 && $topSaleProduct->value->base_price <= 0)
                                    <span
                                        class="new-price">{{ formatPriceWithBdCurrency($topSaleProduct->value->sale_price) }}</span>
                                @endif
                            </div><!-- End .product-price -->
                            @php
                                if (count($topSaleProduct->reviews) > 0) {
                                    $rating = $topSaleProduct->reviews->sum('rating') / count($topSaleProduct->reviews);
                                } else {
                                    $rating = 0;
                                }
                            @endphp

                            @if(count($topSaleProduct->reviews) > 0)
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: {{ $rating * 20 }}%;"></div>
                                        <!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">({{ count($topSaleProduct->reviews) }} Reviews)</span>
                                </div><!-- End .rating-container -->
                            @endif
                        </div><!-- End .product-body -->
                    </div>
                @endforeach
            </div><!-- End .owl-carousel -->
        </div><!-- .End .tab-pane -->
        @foreach($topSaleSubCategories as $topSaleCat)
            <div class="tab-pane p-0 fade" id="top-sale-{{ strtolower(str_replace(' ', '-', $topSaleCat->name)) }}-tab"
                 role="tabpanel"
                 aria-labelledby="top-sale-{{ strtolower(str_replace(' ', '-', $topSaleCat->name)) }}-link">
                <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow"
                     data-toggle="owl"
                     data-owl-options='{
                                        "nav": true,
                                        "dots": false,
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
                                            }
                                        }
                                    }'>
                    @foreach($topSaleCat->products as $topSaleProduct)
                        <div class="product product-2">
                            <figure class="product-media">
                                @if($topSaleProduct->value->stock <= 0)
                                    <span
                                        class="product-label  {{ \App\Enum\LabelColor::labelColor('out') }}">
                                            {{ 'Out of Stock' }}
                                        </span>
                                @endif
                                @if($topSaleProduct->labels)
                                    @foreach($topSaleProduct->labels as $label)
                                        @php
                                            $labelClass = \App\Enum\LabelColor::labelColor(strtolower($label['name']));
                                        @endphp
                                        <span class="product-label label-circle {{ $labelClass }}">
                                        {{ ucfirst($label['name']) }}
                                    </span>
                                    @endforeach
                                @endif
                                <a href="{{ route('frontend.shop.product', $topSaleProduct->slug) }}">
                                    <img loading="lazy" src="{{ getImageUrl($topSaleProduct->featured_image) }}"
                                         alt="Product image" class="product-image">
                                </a>

                                <livewire:add-to-wishlist :product="$topSaleProduct"
                                                          :wire:key="time().$topSaleProduct->id"/>

                                <div class="product-action">
                                    <a href="{{ route('frontend.shop.product', $topSaleProduct->slug) }}"
                                       class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>
                                    <a href="{{ route('product.quickview', $topSaleProduct->slug) }}"
                                       class="btn-product btn-quickview"
                                       title="Quick view"><span>quick view</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="{{ route('frontend.shop.index', ['category' => $topSaleProduct->sub_category_name]) }}">
                                        {{ $topSaleProduct->sub_category_name }}</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a
                                        href="{{ route('frontend.shop.product', $topSaleProduct->slug) }}">
                                        {{ $topSaleProduct->name }}
                                    </a>
                                    @if($topSaleProduct->value->promo_price > 0)
                                        <span class="badge badge-warning p-2">Promo</span>
                                    @endif
                                    @if($topSaleProduct->condition)
                                        <br>
                                        <span
                                            class="badge badge-primary">{{ ucfirst($topSaleProduct->condition) }}</span>
                                    @endif
                                </h3>
                                <div class="product-price">
                                    @if($topSaleProduct->value->promo_price > 0)
                                        <div class="mr-4">
                                            <span
                                                class="new-price">{{ formatPriceWithBdCurrency($topSaleProduct->value->promo_price) }}</span>
                                            <span
                                                class="old-price">{{ formatPriceWithBdCurrency($topSaleProduct->value->sale_price) }}</span>
                                            <span style="font-size: 12px;">save
                                                    {{ round((($topSaleProduct->value->sale_price - $topSaleProduct->value->promo_price) / $topSaleProduct->value->sale_price) * 100) }}
                                                     %
                                                </span>
                                        </div>
                                    @endif

                                    @if($topSaleProduct->value->base_price > 0)
                                        <div>
                                            <span
                                                class="new-price">{{ formatPriceWithBdCurrency($topSaleProduct->value->sale_price) }}</span>
                                            <span
                                                class="old-price">{{ formatPriceWithBdCurrency($topSaleProduct->value->base_price) }}</span>
                                            <span style="font-size: 12px;">save
                                                    {{ round((($topSaleProduct->value->base_price - $topSaleProduct->value->sale_price) / $topSaleProduct->value->base_price) * 100) }}
                                                     %
                                                </span>
                                        </div>
                                    @endif

                                    @if($topSaleProduct->value->promo_price <= 0 && $topSaleProduct->value->base_price <= 0)
                                        <span
                                            class="new-price">{{ formatPriceWithBdCurrency($topSaleProduct->value->sale_price) }}</span>
                                    @endif
                                </div><!-- End .product-price -->
                                @php
                                    if (count($topSaleProduct->reviews) > 0) {
                                        $rating = $topSaleProduct->reviews->sum('rating') / count($topSaleProduct->reviews);
                                    } else {
                                        $rating = 0;
                                    }
                                @endphp
                                @if(count($topSaleProduct->reviews) > 0)
                                    <div class="ratings-container">
                                        <div class="ratings">
                                            <div class="ratings-val" style="width: {{ $rating * 20 }}%;"></div>
                                            <!-- End .ratings-val -->
                                        </div><!-- End .ratings -->
                                        <span
                                            class="ratings-text">({{ count($topSaleProduct->reviews) }} Reviews)</span>
                                    </div><!-- End .rating-container -->
                                @endif
                            </div><!-- End .product-body -->
                        </div>
                    @endforeach
                </div><!-- End .owl-carousel -->
            </div>
        @endforeach
    </div><!-- End .tab-content -->
</div>
