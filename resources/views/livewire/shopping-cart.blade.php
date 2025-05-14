<div>
    <div class="dropdown cart-dropdown">
        <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true"
           aria-expanded="false" data-display="static">
            <div class="icon">
                <i class="icon-shopping-cart"></i>
                <span class="cart-count">{{ count($cartItems) ?? 0 }}</span>
            </div>
            <p>Cart</p>
        </a>

        <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-cart-products">
                @foreach($cartItems as $key => $item)
                    @php
                        $product = \App\Models\Product::find($item['product_id']);
                    @endphp
                    <div class="product" wire:key="pro-item-{{$key}}">
                        <div class="product-cart-details">
                            <h4 class="product-title">
                                <a href="{{ route('frontend.shop.product', $product->slug) }}">{{ $product->name }}</a>
                            </h4>

                            <span class="cart-product-info">
                                <span class="cart-product-qty">{{ $item['quantity'] }}</span>
                                      x ৳{{ $item['price'] }}
                            </span>
                            @if(isset($item['variants']) && count($item['variants']) > 0)
                                <div>
                                    @foreach($item['variants'] as $varKey => $variant)
                                        <span class=""><strong>{{ $varKey }}</strong>:</span>
                                        {{ $variant }} <br>
                                    @endforeach
                                </div>
                            @endif
                        </div>


                        @if(isset($item['attributes']) && count($item['attributes']) > 0)
                            @foreach($item['attributes'] as $attrKey => $attr)
                                <div class="product-cart-details ml-3">
                                    <h4 class="product-title">
                                        {{ \App\Models\ProductAttribute::find($attrKey)->name }}
                                    </h4>

                                    <span class="cart-product-info">
                                <span class="cart-product-qty">{{ \App\Models\ProductAttributeValue::find($attrKey)?->value }}</span>
                            </span>
                                </div>
                            @endforeach
                        @endif

                        <figure class="product-image-container">
                            <a href="{{ route('frontend.shop.product', $product->slug) }}" class="product-image">
                                <img loading="lazy" src="{{ getImageUrl($product->featured_image) }}"
                                     alt="product image">
                            </a>
                        </figure>
                        @if(auth()->check())
                            <button wire:click="removeCartItem('{{ $item['id'] }}')" class="btn-remove" title="Remove Product"><i
                                    class="icon-close"></i></button>
                        @else
                            <button wire:click="removeCartItem('{{ $key }}')" class="btn-remove" title="Remove Product"><i
                                    class="icon-close"></i></button>
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="dropdown-cart-total">
                <span>Total</span>

                <span class="cart-total-price">৳{{ number_format($totalPrice, 2) }}</span>
            </div><!-- End .dropdown-cart-total -->

            <div class="dropdown-cart-action">
                <a href="{{ route('frontend.products.cart') }}" class="btn btn-primary">View Cart</a>

                @if( count($cartItems) > 0 )
                    <a href="{{ route('frontend.products.checkout') }}"
                       class="btn btn-outline-primary-2"><span>Checkout</span><i class="icon-long-arrow-right"></i>
                    </a>
                @endif

            </div><!-- End .dropdown-cart-total -->
        </div><!-- End .dropdown-menu -->
    </div>
</div>
