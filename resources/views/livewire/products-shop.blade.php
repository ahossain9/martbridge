<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                @if (session()->has('message'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        {{ session()->get('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="toolbox">
                    <div class="toolbox-left">
                        <div class="toolbox-info">
                            @php $total = $products->count() ?? 0; @endphp
                            Showing
                            <span>{{ $total < 24 ? $total : $products->perPage() }} of {{ $products->count() ?? 0 }}</span>
                            Products
                        </div><!-- End .toolbox-info -->
                    </div><!-- End .toolbox-left -->

                    <div class="toolbox-right">
                        <div class="toolbox-sort">
                            <label for="sortby">Sort by:</label>
                            <div class="select-custom">
                                <select name="sortby" id="sortby" class="form-control">
                                    <option value="popularity" selected="selected">Most Popular</option>
                                    <option value="rating">Most Rated</option>
                                    <option value="date">Date</option>
                                </select>
                            </div>
                        </div><!-- End .toolbox-sort -->
                    </div><!-- End .toolbox-right -->
                </div><!-- End .toolbox -->

                <div class="products mb-3">
                    <div class="row justify-content-center">
                        @foreach($products as $product)
                            @php
                                $productImg = $product->featured_image;
                            @endphp

                            @if($productImg)
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
                                                     alt="Product image" class="product-image" width="280"
                                                     style="height: 220px!important;">
                                            </a>

                                            <livewire:add-to-wishlist :product="$product"
                                                                      :wire:key="time().$product->id"/>

                                            <div class="product-action">
                                                <a href="{{ route('frontend.shop.product', $product->slug) }}"
                                                   class="btn-product btn-cart"
                                                   title="Add to cart"><span>add to cart</span></a>
                                                <a href="{{ route('product.quickview', $product->slug) }}"
                                                   class="btn-product btn-quickview"
                                                   title="Quick view"><span>quick view</span></a>
                                            </div><!-- End .product-action -->
                                        </figure><!-- End .product-media -->

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
                                                @if($product->condition && $product->condition != 'null')
                                                    <br>
                                                    <span class="badge badge-primary">{{ ucfirst($product->condition) }}</span>
                                                @endif
                                            </h3>
                                            <div class="product-price">
                                                @if($product->value->promo_price > 0)
                                                    <div class="mr-4">
                                                        <span class="new-price">{{ formatPriceWithBdCurrency($product->value->promo_price) }}</span>
                                                        <span class="old-price">{{ formatPriceWithBdCurrency($product->value->sale_price) }}</span>
                                                        <span style="font-size: 12px;">save
                                                    {{ round((($product->value->sale_price - $product->value->promo_price) / $product->value->sale_price) * 100) }}
                                                     %
                                                </span>
                                                    </div>
                                                @endif

                                                @if($product->value->base_price > 0)
                                                    <div>
                                                        <span class="new-price">{{ formatPriceWithBdCurrency($product->value->sale_price) }}</span>
                                                        <span class="old-price">{{ formatPriceWithBdCurrency($product->value->base_price) }}</span>
                                                        <span style="font-size: 12px;">save
                                                    {{ round((($product->value->base_price - $product->value->sale_price) / $product->value->base_price) * 100) }}
                                                     %
                                                </span>
                                                    </div>
                                                @endif

                                                @if($product->value->promo_price <= 0 && $product->value->base_price <= 0)
                                                    <span class="new-price">{{ formatPriceWithBdCurrency($product->value->sale_price) }}</span>
                                                @endif
                                            </div><!-- End .product-price -->
                                            <div class="ratings-container">
                                                <div class="ratings">
                                                    @php
                                                        if (count($product->reviews) > 0) {
                                                            $rating = $product->reviews->sum('rating') / count($product->reviews);
                                                        } else {
                                                            $rating = 0;
                                                        }
                                                    @endphp
                                                    <div class="ratings-val" style="width: {{ $rating * 20 }}%;"></div>
                                                    <!-- End .ratings-val -->
                                                </div><!-- End .ratings -->
                                                <span class="ratings-text">({{ count($product->reviews) }} Reviews)</span>
                                            </div><!-- End .rating-container -->
                                        </div><!-- End .product-body -->
                                    </div>
                                </div>
                            @endif
                        @endforeach

                    </div>
                    @if(count($products)==0)
                        <div class="col-12">
                            <div class="" role="">
                                <p class="text-center"><strong>Sorry!</strong> No products found.</p>
                            </div>
                        </div>
                    @endif
                </div><!-- End .products -->


                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        {{ $products->links() }}
                    </ul>
                </nav>
            </div><!-- End .col-lg-9 -->
            <aside class="col-lg-3 order-lg-first">
                <div class="sidebar sidebar-shop">
                    <div class="widget widget-clean">
                        <label>Filters:</label>
                        <a href="{{ route('frontend.shop.index') }}" class="">Clean All</a>
                    </div>

                    <div class="widget widget-collapsible">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#sub-category-filter" role="button" aria-expanded="true"
                               aria-controls="sub-category-filter">
                                Category
                            </a>
                        </h3>

                        <div class="collapse show" id="sub-category-filter">
                            <div class="widget-body">
                                <div class="filter-items filter-items-count">
                                    @foreach(\App\Helpers\ProductHelper::subCategoriesWithCount() as $cat)
                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input"
                                                       id="cat-{{ $cat->slug  }}" value="{{ $cat->name }}"
                                                       wire:model="selectedCategories"
                                                >
                                                <label class="custom-control-label"
                                                       for="cat-{{ $cat->slug  }}">{{ $cat->name }}</label>
                                            </div>
                                            <span class="item-count">{{ $cat->products_count }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="widget widget-collapsible">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#product-condition-filter" role="button" aria-expanded="true"
                               aria-controls="sub-category-filter">
                                Condition
                            </a>
                        </h3>

                        <div class="collapse show" id="product-condition-filter">
                            <div class="widget-body">
                                <div class="filter-items filter-items-count">
                                    @foreach(\App\Enum\ProductCondition::conditions() as $condition)
                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input"
                                                       id="condition-{{ $condition->value  }}" value="{{ $condition->value }}"
                                                       wire:model="conditions"
                                                >
                                                <label class="custom-control-label"
                                                       for="condition-{{ $condition->value  }}">
                                                    {{ $condition->name }}
                                                </label>
                                            </div>
                                            <span class="item-count">{{ \App\Helpers\ProductHelper::countProductByCondition($condition->value) }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="widget widget-collapsible">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#brands-filter" role="button" aria-expanded="true"
                               aria-controls="brands-filter">
                                Brand
                            </a>
                        </h3>

                        <div class="collapse show" id="brands-filter">
                            <div class="widget-body">
                                <div class="filter-items filter-items-count">
                                    @foreach(\App\Helpers\ProductHelper::brandsWithCount() as $brand)
                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input"
                                                       id="brand-{{ $brand->slug }}"
                                                       wire:model="brands"
                                                       value="{{ $brand->name }}">
                                                <label class="custom-control-label"
                                                       for="brand-{{ $brand->slug }}">{{ $brand->name }}</label>
                                            </div>
                                            <span class="item-count">{{ $brand->products_count }}</span>
                                        </div><!-- End .filter-item -->
                                    @endforeach
                                </div><!-- End .filter-items -->
                            </div><!-- End .widget-body -->
                        </div><!-- End .collapse -->
                    </div>
                </div><!-- End .sidebar sidebar-shop -->
            </aside><!-- End .col-lg-3 -->
        </div><!-- End .row -->
    </div><!-- End .container -->
</div>
