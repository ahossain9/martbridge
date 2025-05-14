<div class="page-content">
    <div class="cart">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    @include('admin.partials.message')

                    @if(count($cartItems) == 0)
                        <p class="text-center">No Items in the cart. <a href="{{ route('frontend.shop.index') }}">Shop
                                Now</a></p>
                    @else
                        <table class="table table-cart table-mobile">
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Variants</th>
                                <th>Attributes</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($cartItems as $key => $item)
                                <tr>
                                    @php
                                        $product = \App\Models\Product::findOrFail($item['product_id']);
                                    @endphp
                                    <td class="product-col">
                                        <div class="product">
                                            <figure class="product-media">
                                                <a href="{{ route('frontend.shop.product', $product->slug) }}">
                                                    <img loading="lazy" src="{{ getImageUrl($product->featured_image) }}"
                                                         alt="Product image">
                                                </a>
                                            </figure>

                                            <h3 class="product-title">
                                                <a href="{{ route('frontend.shop.product', $product->slug) }}">{{ $product->name }}</a>
                                            </h3><!-- End .product-title -->
                                        </div><!-- End .product -->
                                    </td>
                                    <td class="price-col">৳{{ number_format($item['price'], 2) }}</td>
                                    <td class="quantity-col">
                                        <div class="cart-product-quantity">
                                            <input
                                                wire:change="updateItemQuantity('{{ $key }}', {{ $product->id }}, '{{ json_encode($product->attributes) }}' ,'{{ json_encode($item['variants']) }}')"
                                                wire:model="itemQuantity.{{ $key }}"
                                                type="number" class="form-control" min="1" max="10" step="1"
                                                data-decimals="0" required
                                            >
                                        </div>
                                    </td>
                                    <td>
                                        <div class="" style="margin-right: 10px;">
                                            @if(isset($item['variants']) && count($item['variants']) > 0)
                                                @foreach($item['variants'] as $varKey => $variant)
                                                    <span class=""><strong>{{ $varKey }}</strong>:</span>
                                                    {{ $variant }} <br>
                                                @endforeach
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="" style="margin-right: 10px;">
                                            @forelse($product->attributes as $attribute)
                                                <strong>{{ $attribute->name }}:</strong>
                                                <div class="select-custom ">
                                                    <select id="select-103" class="form-control"
                                                            wire:model="selectedAttributes.{{ $product->id }}.{{ $attribute->id }}"
                                                            wire:change="updateProductAttributes({{ $product->id }}, {{ $attribute->id }}, $event.target.value)"
                                                    >
                                                        <option value="">Select a {{ $attribute->name }}</option>
                                                        @foreach($attribute->values as $value)
                                                            <option
                                                                value="{{ $value->id }}">{{ $value->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @empty
                                                <p>N/A</p>
                                            @endforelse
                                        </div>
                                    </td>
                                    <td class="total-col">৳{{ number_format($item['price'] * $item['quantity']) }}</td>
                                    <td class="remove-col">
                                        @if(auth()->check())
                                            <button wire:click="removeItemFromCartPage('{{ $item['id'] }}')" class="btn-remove" title="Remove Product"><i
                                                    class="icon-close"></i></button>
                                        @else
                                            <button wire:click="removeItemFromCartPage('{{ $key }}')" class="btn-remove" title="Remove Product"><i
                                                    class="icon-close"></i></button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif

                    <div class="cart-bottom">
                        @if(count($cartItems) > 0)
                            <div class="cart-discount">
                                <form action="#">
                                    <div class="input-group">
                                        <input type="text" class="form-control" required placeholder="coupon code">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-primary-2" type="submit"><i
                                                    class="icon-long-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif
                        <button
                            wire:click="checkAttributes"
                            class="btn btn-outline-dark-2 {{ count($cartItems) > 0 ? '' : 'disabled' }}">
                            <span>CHECKOUT</span></button>
                    </div><!-- End .cart-bottom -->
                </div><!-- End .col-lg-9 -->
                <aside class="col-lg-3">
                    <div class="summary summary-cart">
                        <h3 class="summary-title">Cart Total</h3>

                        <table class="table table-summary">
                            <tbody>
                            <tr class="summary-subtotal">
                                <td>Subtotal:</td>
                                <td>৳{{ number_format($totalPrice, 2) }}</td>
                            </tr>

                            <tr class="summary-total">
                                <td>Total:</td>
                                <td>৳{{ number_format($totalPrice, 2) }}</td>
                            </tr><!-- End .summary-total -->
                            </tbody>
                        </table><!-- End .table table-summary -->

                        <button
                            class="btn btn-outline-primary-2 btn-order btn-block {{ count($cartItems) > 0 ? '' : 'disabled' }}"
                            wire:click="checkAttributes"
                        >PROCEED TO CHECKOUT
                        </button>
                    </div><!-- End .summary -->

                    <a href="{{ route('frontend.shop.index') }}" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE SHOPPING</span><i
                            class="icon-refresh"></i></a>
                </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .cart -->
</div><!-- End .page-content -->
