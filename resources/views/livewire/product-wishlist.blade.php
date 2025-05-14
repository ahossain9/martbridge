<div class="page-content">
    <div class="container">
        <table class="table table-wishlist table-mobile">
            <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Stock Status</th>
                <th></th>
                <th></th>
            </tr>
            </thead>

            <tbody>
            @foreach($wishlistProducts as $wishlistProduct)
                @php
                    $product = $wishlistProduct->product;
                @endphp
                <tr>
                    <td class="product-col">
                        <div class="product">
                            <figure class="product-media">
                                <a href="{{ route('frontend.shop.product', $product->slug) }}">
                                    <img loading="lazy" src="{{ getImageUrl($product->featured_image) }}" alt="Product image">
                                </a>
                            </figure>

                            <h3 class="product-title">
                                <a href="{{ route('frontend.shop.product', $product->slug) }}">{{ $product->name }}</a>
                            </h3><!-- End .product-title -->
                        </div><!-- End .product -->
                    </td>
                    <td class="price-col">
                        @if($product->value->promo_price > 0)
                            <span class="new-price">{{ formatPriceWithBdCurrency($product->value->promo_price) }}</span>
                            <span
                                class="old-price">{{ formatPriceWithBdCurrency($product->value->sale_price) }}
                            </span>
                        @else
                            <span
                                class="new-price">{{ formatPriceWithBdCurrency($product->value->sale_price) }}
                            </span>
                        @endif
                    </td>
                        <td class="stock-col">
                            @if($product->value->stock > 0)
                                <span class="in-stock">In stock</span>
                            @else
                                <span class="out-of-stock">Out of stock</span>
                            @endif
                        </td>
                    <td class="remove-col">
                        <button wire:click="removeFromWishList({{ $product->id }})" class="btn-remove"><i class="icon-close"></i></button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table><!-- End .table table-wishlist -->
        <div class="wishlist-share">
            <div class="social-icons social-icons-sm mb-2">
                <label class="social-label">Connect on:</label>
                <a href="https://www.facebook.com/techstronixshop" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                <a href="https://www.instagram.com/techstronix" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                <a href="#" class="social-icon" title="Youtube" target="_blank"><i class="icon-youtube"></i></a>
            </div><!-- End .soial-icons -->
        </div><!-- End .wishlist-share -->
    </div><!-- End .container -->
</div>
