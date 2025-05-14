<div class="container trending">
    <div class="heading heading-flex mb-3">
        <div class="heading-left">
            <h2 class="title">Trending Products</h2><!-- End .title -->
        </div><!-- End .heading-left -->

        <div class="heading-right">
            <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="trending-all-link" data-toggle="tab" href="#trending-all-tab"
                       role="tab" aria-controls="trending-all-tab" aria-selected="true">All</a>
                </li>
                @foreach($trendingSubCategories as $subCat)
                    <li class="nav-item">
                        <a class="nav-link" id="trending-{{ strtolower(str_replace(' ', '-', $subCat->name)) }}-link"
                           data-toggle="tab" href="#trending-{{ strtolower(str_replace(' ', '-', $subCat->name)) }}-tab"
                           role="tab" aria-controls="trending-tv-tab" aria-selected="false">{{ $subCat->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div><!-- End .heading-right -->
    </div>
    <div class="row">
        @if($tendingProductBanner)
            <div class="col-xl-5col d-none d-xl-block">
                <div class="banner">
                    <a href="{{ $tendingProductBanner->link  ?? '#' }}">
                        <img src="{{ getImageUrl($tendingProductBanner->image) }}" loading="lazy" alt="banner">
                    </a>
                </div><!-- End .banner -->
            </div><!-- End .col-xl-5col -->
        @endif
        <div class="col-xl-4-5col">
            <div class="tab-content tab-content-carousel just-action-icons-sm">
                <div class="tab-pane p-0 fade show active" id="trending-all-tab" role="tabpanel"
                     aria-labelledby="trending-all-link">
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

                        @foreach($allProducts as $tProduct)
                            <div class="product product-2">
                                <figure class="product-media">
                                    @if($tProduct->value->stock <= 0)
                                        <span
                                            class="product-label  {{ \App\Enum\LabelColor::labelColor('out') }}">
                                            {{ 'Out of Stock' }}
                                        </span>
                                    @endif
                                    @if($tProduct->labels)
                                        @foreach($tProduct->labels as $label)
                                            @php
                                                $labelClass = \App\Enum\LabelColor::labelColor(strtolower($label['name']));
                                            @endphp
                                            <span class="product-label label-circle {{ $labelClass }}">
                                        {{ ucfirst($label['name']) }}
                                    </span>
                                        @endforeach
                                    @endif
                                    <a href="{{ route('frontend.shop.product', $tProduct->slug) }}">
                                        <img loading="lazy" src="{{ getImageUrl($tProduct->featured_image) }}"
                                             style="width: 300px; height: 274px"
                                             alt="Product image" class="product-image">
                                    </a>

                                    <livewire:add-to-wishlist :product="$tProduct" :wire:key="time().$tProduct->id"/>

                                    <div class="product-action">
                                        <a href="{{ route('frontend.shop.product', $tProduct->slug) }}"
                                           class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>
                                        <a href="{{ route('product.quickview', $tProduct->slug) }}" class="btn-product btn-quickview"
                                           title="Quick view"><span>quick view</span></a>
                                    </div><!-- End .product-action -->
                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <div class="product-cat">
                                        <a href="{{ route('frontend.shop.index', ['category' => $tProduct->sub_category_name]) }}">
                                            {{ $tProduct->sub_category_name }}</a>
                                    </div><!-- End .product-cat -->
                                    <h3 class="product-title">
                                        <a
                                            href="{{ route('frontend.shop.product', $tProduct->slug) }}">
                                            {{ $tProduct->name }}
                                        </a>
                                        @if($tProduct->value->promo_price > 0)
                                            <span class="badge badge-warning p-2">Promo</span>
                                        @endif
                                        @if($tProduct->condition)
                                            <br>
                                            <span class="badge badge-primary">{{ ucfirst($tProduct->condition) }}</span>
                                        @endif
                                    </h3>
                                    <div class="product-price">
                                        @if($tProduct->value->promo_price > 0)
                                            <div class="mr-4">
                                                <span class="new-price">{{ formatPriceWithBdCurrency($tProduct->value->promo_price) }}</span>
                                                <span class="old-price">{{ formatPriceWithBdCurrency($tProduct->value->sale_price) }}</span>
                                                <span style="font-size: 12px;">save
                                                    {{ round((($tProduct->value->sale_price - $tProduct->value->promo_price) / $tProduct->value->sale_price) * 100) }}
                                                     %
                                                </span>
                                            </div>
                                        @endif

                                        @if($tProduct->value->base_price > 0)
                                            <div>
                                                <span class="new-price">{{ formatPriceWithBdCurrency($tProduct->value->sale_price) }}</span>
                                                <span class="old-price">{{ formatPriceWithBdCurrency($tProduct->value->base_price) }}</span>
                                                <span style="font-size: 12px;">save
                                                    {{ round((($tProduct->value->base_price - $tProduct->value->sale_price) / $tProduct->value->base_price) * 100) }}
                                                     %
                                                </span>
                                            </div>
                                        @endif

                                        @if($tProduct->value->promo_price <= 0 && $tProduct->value->base_price <= 0)
                                            <span class="new-price">{{ formatPriceWithBdCurrency($tProduct->value->sale_price) }}</span>
                                        @endif
                                    </div><!-- End .product-price -->
                                    @php
                                        if (count($tProduct->reviews) > 0) {
                                            $rating = $tProduct->reviews->sum('rating') / count($tProduct->reviews);
                                        } else {
                                            $rating = 0;
                                        }
                                    @endphp
                                    @if(count($tProduct->reviews) > 0)
                                        <div class="ratings-container">
                                            <div class="ratings">
                                                <div class="ratings-val" style="width: {{ $rating * 20 }}%;"></div>
                                                <!-- End .ratings-val -->
                                            </div><!-- End .ratings -->
                                            <span class="ratings-text">({{ count($tProduct->reviews) }} Reviews)</span>
                                        </div><!-- End .rating-container -->
                                    @endif
                                </div><!-- End .product-body -->
                            </div>
                        @endforeach
                    </div>
                </div>
                @foreach($trendingSubCategories as $subCat)
                    <div class="tab-pane p-0 fade"
                         id="trending-{{ strtolower(str_replace(' ', '-', $subCat->name)) }}-tab" role="tabpanel"
                         aria-labelledby="trending-{{ strtolower(str_replace(' ', '-', $subCat->name)) }}-link">
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
                            @foreach($subCat->products as $productTrending)
                                <div class="product product-2">
                                    <figure class="product-media">
                                        @if($productTrending->condition)
                                            <span class="product-label label-primary">{{ ucfirst($productTrending->condition) }}</span>
                                        @endif
                                        @if($productTrending->value->stock <= 0)
                                            <span
                                                class="product-label  {{ \App\Enum\LabelColor::labelColor('out') }}">
                                            {{ 'Out of Stock' }}
                                        </span>
                                        @endif
                                        @if($productTrending->labels)
                                            @foreach($productTrending->labels as $label)
                                                @php
                                                    $labelClass = \App\Enum\LabelColor::labelColor(strtolower($label['name']));
                                                @endphp
                                                <span class="product-label label-circle {{ $labelClass }}">
                                        {{ ucfirst($label['name']) }}
                                    </span>
                                            @endforeach
                                        @endif
                                        <a href="{{ route('frontend.shop.product', $productTrending->slug) }}">
                                            <img loading="lazy"
                                                 src="{{ getImageUrl($productTrending->featured_image) }}"
                                                 style="width: 300px; height: 274px"
                                                 alt="Product image" class="product-image">
                                        </a>

                                        <livewire:add-to-wishlist :product="$productTrending" :wire:key="time().$productTrending->id"/>

                                        <div class="product-action">
                                            <a href="{{ route('frontend.shop.product', $productTrending->slug) }}"
                                               class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>
                                            <a href="{{ route('product.quickview', $productTrending->slug) }}" class="btn-product btn-quickview"
                                               title="Quick view"><span>quick view</span></a>
                                        </div><!-- End .product-action -->
                                    </figure><!-- End .product-media -->

                                    <div class="product-body">
                                        <div class="product-cat">
                                            <a href="{{ route('frontend.shop.index', ['category' => $productTrending->sub_category_name]) }}">
                                                {{ $productTrending->sub_category_name }}</a>
                                        </div><!-- End .product-cat -->
                                        <h3 class="product-title"><a
                                                href="{{ route('frontend.shop.product', $productTrending->slug) }}">
                                                {{ $productTrending->name }}
                                            </a>
                                            @if($productTrending->value->promo_price > 0)
                                                <span class="badge badge-warning p-2">Promo</span>
                                            @endif
                                            @if($productTrending->condition)
                                                <br>
                                                <span class="badge badge-primary">{{ ucfirst($productTrending->condition) }}</span>
                                            @endif
                                        </h3>
                                        <div class="product-price">
                                            @if($productTrending->value->promo_price > 0)
                                                <div class="mr-4">
                                                    <span class="new-price">{{ formatPriceWithBdCurrency($productTrending->value->promo_price) }}</span>
                                                    <span class="old-price">{{ formatPriceWithBdCurrency($productTrending->value->sale_price) }}</span>
                                                    <span style="font-size: 12px;">save
                                                    {{ round((($productTrending->value->sale_price - $productTrending->value->promo_price) / $productTrending->value->sale_price) * 100) }}
                                                     %
                                                </span>
                                                </div>
                                            @endif

                                            @if($productTrending->value->base_price > 0)
                                                <div>
                                                    <span class="new-price">{{ formatPriceWithBdCurrency($productTrending->value->sale_price) }}</span>
                                                    <span class="old-price">{{ formatPriceWithBdCurrency($productTrending->value->base_price) }}</span>
                                                    <span style="font-size: 12px;">save
                                                    {{ round((($productTrending->value->base_price - $productTrending->value->sale_price) / $productTrending->value->base_price) * 100) }}
                                                     %
                                                </span>
                                                </div>
                                            @endif

                                            @if($productTrending->value->promo_price <= 0 && $productTrending->value->base_price <= 0)
                                                <span class="new-price">{{ formatPriceWithBdCurrency($productTrending->value->sale_price) }}</span>
                                            @endif
                                        </div><!-- End .product-price -->
                                        @php
                                            if (count($productTrending->reviews) > 0) {
                                                $rating = $productTrending->reviews->sum('rating') / count($productTrending->reviews);
                                            } else {
                                                $rating = 0;
                                            }
                                        @endphp
                                        @if(count($productTrending->reviews) > 0)
                                            <div class="ratings-container">
                                                <div class="ratings">
                                                    <div class="ratings-val" style="width: {{ $rating * 20 }}%;"></div>
                                                    <!-- End .ratings-val -->
                                                </div><!-- End .ratings -->
                                                <span class="ratings-text">({{ count($productTrending->reviews) }} Reviews)</span>
                                            </div><!-- End .rating-container -->
                                        @endif
                                    </div><!-- End .product-body -->
                                </div>
                            @endforeach
                        </div><!-- End .owl-carousel -->
                    </div>
                @endforeach
            </div><!-- End .tab-content -->
        </div><!-- End .col-xl-4-5col -->
    </div>
</div>
