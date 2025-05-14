@php
    $reviews_count = $product->reviews->count() ?? 0;
    $product_first_img = $product->featured_image;
@endphp

<div class="col-lg-9">
    <div class="product-details-top">
        <div class="row">
            <div class="col-md-6">
                <div class="product-gallery">
                    <figure class="product-main-image">
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

                        <img id="product-zoom"
                             loading="lazy"
                             src="{{ getImageUrl($product_first_img) }}" style="width: 350px; height: 380px;"
                             data-zoom-image="{{ getImageUrl($product_first_img) }}" alt="product image">

                        <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                            <i class="icon-arrows"></i>
                        </a>
                    </figure>

                    <div id="product-zoom-gallery" class="product-image-gallery">
                        <a class="product-gallery-item active" href="#"
                           data-image="{{ getImageUrl($product_first_img) }}"
                           data-zoom-image="{{ getImageUrl($product_first_img) }}">
                            <img loading="lazy" src="{{ getImageUrl($product_first_img) }}" alt="product side">
                        </a>

                        @foreach($product->galleries as $gallery)
                            <a class="product-gallery-item" href="#"
                               data-image="{{ getImageUrl($gallery->images->large_image) }}"
                               data-zoom-image="{{ getImageUrl($gallery->images->large_image) }}">
                                <img loading="lazy" src="{{ getImageUrl($gallery->images->large_image) }}"
                                     style="width: 60px; height: 60px;"
                                     alt="product cross">
                            </a>
                        @endforeach
                    </div><!-- End .product-image-gallery -->
                </div><!-- End .product-gallery -->
            </div><!-- End .col-md-6 -->

            <div class="col-md-6">
                @if (session()->has('message'))
                    <div class="alert alert-info alert-dismissible fade show mb-2" role="alert">
                        {{ session()->get('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="product-details product-details-sidebar">
                    <div>
                        <h1 class="product-title">{{ $product->name }}</h1>
                        @if($product->condition && $product->condition != 'null')
                            <span class="badge badge-primary">{{ ucfirst($product->condition) }}</span>
                        @endif
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
                        @if($initialPrice > 0)
                            <span class="new-price">{{ formatPriceWithBdCurrency($initialPrice) }}</span>
                        @else
                            @if($product->value->promo_price > 0)
                                <div class="mr-4">
                                <span
                                    class="new-price">{{ formatPriceWithBdCurrency($product->value->promo_price) }}</span>
                                    <span
                                        class="old-price">{{ formatPriceWithBdCurrency($product->value->sale_price) }}</span>
                                </div>
                            @endif

                            @if($product->value->base_price > 0)
                                <div>
                                <span
                                    class="new-price">{{ formatPriceWithBdCurrency($product->value->sale_price) }}</span>
                                    <span
                                        class="old-price">{{ formatPriceWithBdCurrency($product->value->base_price) }}</span>
                                </div>
                            @endif

                            @if($product->value->promo_price <= 0 && $product->value->base_price <= 0)
                                <span class="new-price">{{ formatPriceWithBdCurrency($product->value->sale_price) }}</span>
                            @endif
                        @endif

                    </div>

                    @if($product->value->promo_price > 0 || $product->value->base_price > 0)
                        <div class="d-inline-flex mt-1">
                            <label class="">
                                @php
                                    $basePrice = $product->value->base_price;
                                    $promoPrice = $product->value->promo_price;
                                    $salePrice = $product->value->sale_price;
                                        if ($basePrice > 0 && $promoPrice > 0) {
                                            $discount = ($basePrice - $promoPrice) / $basePrice;
                                            $discountedPrice = $basePrice - $promoPrice;
                                        } elseif ($promoPrice > 0) {
                                            $discount = ($salePrice - $promoPrice) / $salePrice;
                                            $discountedPrice = $salePrice - $promoPrice;
                                        }elseif ($basePrice > 0) {
                                            $discount = ($basePrice - $salePrice) / $basePrice;
                                            $discountedPrice = $basePrice - $salePrice;
                                        } else {
                                            $discount = 0;
                                            $discountedPrice = 0;
                                        }

                                        $discountPercentage = $discount * 100;
                                @endphp

                                @if($discountedPrice > 0)
                                    <div class="text-primary">
                                        You save
                                        <span class="font-weight-bold">
                                            {{ formatPriceWithBdCurrency($discountedPrice) }} ({{ round($discountPercentage) }}%)
                                        </span>
                                    </div>
                                @endif
                            </label>
                        </div>
                    @endif

                    @if($product->short_description)
                        <div class="product-content">
                            <p>{{ $product->short_description }}.</p>
                        </div>
                    @endif

                    <div class="product-details-action">
                        <div class="details-action-col">
                            <label for="qty">Qty:</label>
                            <div class="product-details-quantity">
                                <input type="number" id="qty" class="form-control"
                                       wire:model="qty"
                                       value="1" min="1" max="10" step="1" data-decimals="0" required>
                            </div>
                        </div>

                        @foreach($attributes as $attr)
                            @if ($attr->input_type === 'checkbox')
                                <div class="details-action-col">
                                    <label>{{ $attr->name }}:</label>
                                    @foreach ($attr->values as $val)
                                        <div class="custom-control custom-checkbox custom-control-inline"
                                             style="margin-right: 8px;">
                                            <input type="checkbox"
                                                   wire:model="selectedAttributes.{{ $attr->id }}.{{ $val->id }}"
                                                   class="custom-control-input single-input" id="attr-{{ $val->id }}"
                                                   wire:click="updateSelectedAttributes({{ $attr->id }}, {{ $val->id }}, $event.target.checked)"
                                            >
                                            <label class="custom-control-label"
                                                   for="attr-{{ $val->id }}">{{ $val->value }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            @if($attr->input_type === 'radio')
                                <div class="details-action-col">
                                    <label for="" class="">{{ $attr->name }}:</label>
                                    @foreach($attr->values as $val)
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" wire:model="selectedAttributes.{{ $attr->id }}"
                                                   class="custom-control-input" id="attr-radio-{{ $val->id }}"
                                                   value="{{ $val->id }}"
                                            >
                                            <label class="custom-control-label"
                                                   for="attr-radio-{{ $val->id }}">{{ $val->value }}
                                            </label>
                                        </div>

                                    @endforeach
                                </div>
                            @endif

                            @if ($attr->input_type === 'select')
                                <div class="details-filter-row details-row-size">
                                    <label for="{{ 'select-' . $attr->id }}">{{ $attr->name }}:</label>
                                    <div class="select-custom">
                                        <select wire:model="selectedAttributes.{{ $attr->id }}"
                                                id="{{ 'select-' . $attr->id }}" class="form-control">
                                            <option value="#" selected="selected">Select a {{ $attr->name }}</option>
                                            @foreach ($attr->values as $val)
                                                <option value="{{ $val->id }}">{{ $val->value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                        <div class="mt-1">
                            @foreach ($product->variations as $option)
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <h5>{{ $option['name'] }}</h5>
                                        <div class="btn-group" role="group">
                                            @foreach ($option['values'] as $key => $value)
                                                <button
                                                    :key="{{ $key }}"
                                                    type="button"
                                                    wire:click="toggleValue('{{ $option['name'] }}', '{{ $value['value'] }}')"
                                                    class="small-button {{ $this->isSelected($option['name'], $value['value']) ? 'active' : '' }}"
                                                >
                                                    {{ $value['value'] }}
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="details-action-wrapper mt-1">
                            <button wire:click="addToCart({{ $product->id }})"
                                    class="btn btn-primary btn-round" {{ $product->value->stock <=0 ? 'disabled' : '' }}
                                    @if($product->value->stock <=0)
                                        style="opacity: 0.2"
                                @endif
                            >
                                <span>add to cart</span>
                            </button>
                        </div>
                    </div>

                    <div class="product-details-footer details-footer-col">
                        <div class="product-cat">
                            <span>Category:</span>
                            <a href="#">{{ $product->sub_category_name }}</a>,
                        </div><!-- End .product-cat -->

                        <div class="social-icons social-icons-sm">
                            <span class="social-label">Share:</span>
                            <a href="#" class="social-icon" title="Facebook" target="_blank"><i
                                    class="icon-facebook-f"></i></a>
                            <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                            <a href="#" class="social-icon" title="Instagram" target="_blank"><i
                                    class="icon-instagram"></i></a>
                            <a href="#" class="social-icon" title="Pinterest" target="_blank"><i
                                    class="icon-pinterest"></i></a>
                        </div>
                    </div><!-- End .product-details-footer -->
                </div><!-- End .product-details -->
            </div><!-- End .col-md-6 -->
        </div><!-- End .row -->
    </div>

    <div class="product-details-tab">
        <ul class="nav nav-pills" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab"
                   aria-controls="product-desc-tab" aria-selected="true">Description</a>
            </li>
            <!--                            <li class="nav-item">
                                            <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab" role="tab" aria-controls="product-info-tab" aria-selected="false">Additional information</a>
                                        </li>-->
            <li class="nav-item">
                <a class="nav-link" id="product-shipping-link" data-toggle="tab" href="#product-shipping-tab" role="tab"
                   aria-controls="product-shipping-tab" aria-selected="false">Shipping & Returns</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab" role="tab"
                   aria-controls="product-review-tab" aria-selected="false">Reviews ({{ $reviews_count }})</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel"
                 aria-labelledby="product-desc-link">
                <div class="product-desc-content">
                    <h3>Product Information</h3>
                    {!! $product->description !!}
                </div><!-- End .product-desc-content -->
            </div><!-- .End .tab-pane -->
            <div class="tab-pane fade" id="product-shipping-tab" role="tabpanel"
                 aria-labelledby="product-shipping-link">
                <div class="product-desc-content">
                    <h3>Delivery & returns</h3>
                    <p>We deliver only in Bangladesh at this moment. For full details of the delivery options we offer,
                        please view our <a href="#">Delivery information</a><br>
                        We hope you’ll love every purchase, but if you ever need to return an item you can do so within
                        a month of receipt. For full details of how to make a return, please view our <a href="#">Returns
                            information</a></p>
                </div><!-- End .product-desc-content -->
            </div>

            <livewire:review-form :product="$product" :key="time().$product->id"/>
        </div>
    </div>
</div>

@section('styles')
    <style>
        .rating {
            display: inline-flex;
            align-items: center;
            cursor: pointer;
        }

        .star {
            margin-right: 4px;
        }

        .active {
            color: #ffcc00;
        }
    </style>
@endsection


