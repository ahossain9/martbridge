@extends('frontend.layouts.app')

@section('title', __('Checkout ' . ' | ' . $appName))

@section('page-content')
    <div class="page-header text-center" style="background-image: url('{{ asset('frontend/assets/images/page-header-bg.jpg') }}')">
        <div class="container">
            <h1 class="page-title">Product Checkout<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
        </div>
    </nav>

    <div class="page-content">
        <div class="checkout">
            <div class="container">
                <div class="checkout-discount">
                    <form action="#">
                        <input type="text" class="form-control" required id="checkout-discount-input">
                        <label for="checkout-discount-input" class="text-truncate">Have a coupon? <span>Click here to enter your code</span></label>
                    </form>
                </div><!-- End .checkout-discount -->
                @include('admin.partials.message')
                <form action="{{ route('frontend.products.checkout.submit') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-9">
                            <h2 class="checkout-title">Billing Details</h2><!-- End .checkout-title -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>First Name *</label>
                                    <input type="text" class="form-control" name="first_name"
                                           value="{{ auth()->check() ? auth()->user()->first_name : '' }}"
                                           required>
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-6">
                                    <label>Last Name *</label>
                                    <input type="text" class="form-control" name="last_name"
                                           value="{{ auth()->check() ? auth()->user()->last_name : '' }}"
                                           required>
                                </div><!-- End .col-sm-6 -->
                            </div><!-- End .row -->


                            <label>Country *</label>
                            <input type="text" class="form-control" name="country" value="BD" required>

                            <label>Street address *</label>
                            <input type="text" class="form-control" name="address" placeholder="House number and Street name" required>
                            <input type="text" class="form-control" name="address2" placeholder="Appartments, suite, unit etc ...">

                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Town / City *</label>
                                    <input type="text" class="form-control" name="city" required>
                                </div><!-- End .col-sm-6 -->

                            </div><!-- End .row -->

                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Postcode / ZIP *</label>
                                    <input type="text" class="form-control" name="zip_code" required>
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-6">
                                    <label>Phone *</label>
                                    <input type="tel" class="form-control" name="phone" required>
                                </div><!-- End .col-sm-6 -->
                            </div><!-- End .row -->

                            <label>Email address *</label>
                            <input type="email" class="form-control" name="email"
                                   value="{{ auth()->check() ? auth()->user()->email : '' }}"
                                   required>


                            <label>Order notes (optional)</label>
                            <textarea class="form-control" cols="30" rows="4" placeholder="Notes about your order, e.g. special notes for delivery" name="order_note"></textarea>
                        </div><!-- End .col-lg-9 -->
                        <aside class="col-lg-3">
                            <div class="summary">
                                <h3 class="summary-title">Your Order Summary</h3><!-- End .summary-title -->

                                <table class="table table-summary">
                                    <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Total</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @if(count($cartItems) == 0)
                                        <tr>
                                            <td colspan="2" class="text-center">No item in cart
                                                <a class="text-primary" href="{{ route('frontend.shop.index') }}">
                                                    <i class="icon-shopping-cart"></i> Go to cart
                                                </a>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach($cartItems as $key => $item)
                                            <tr style="margin-bottom: 10px;">
                                                <td class="">
                                                    <a href="{{ \App\Models\Product::find($item['product_id'])->slug }}">
                                                        {{ $item['name'] }}</a>
                                                    <strong> × {{ $item['quantity'] }}</strong>

                                                    @if(isset($item['variants']) && count($item['variants']) > 0)
                                                        @php
                                                            $variant = '';
                                                            foreach($item['variants'] as $varKey => $var) {
                                                                $variant .= $varKey . ': ' . $var . ', ';
                                                            }
                                                        @endphp
                                                        {{ rtrim($variant, ', ')}}
                                                    @endif
                                                </td>
                                                <td>৳{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                            </tr>
                                        @endforeach
                                    @endif

                                    <tr class="summary-total">
                                        <td>Total:</td>
                                        <td>৳{{ number_format($totalPrice + 100, 2) ?? 0.00 }}</td>
                                    </tr>
                                    </tbody>
                                </table>


                                <div class="accordion-summary" id="accordion-payment">

                                    @if(config('delivery'))
                                        @foreach(config('delivery') as $key => $method)
                                            {{-- radio input --}}
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="delivery_method" id="delivery_method_{{ $key }}" data-fee="{{ $method['fee'] }}" value="{{ $key }}" @if('cash_on_delivery_in_city' === $key) checked @endif>
                                                <label class="ml-2 form-check-label" for="delivery_method_{{ $key }}">
                                                    {{ $method['label'] }} ৳{{ $method['fee'] }}
                                                </label>
                                            </div>
                                        @endforeach
                                    @endif
                                </div><!-- End .accordion -->

                                <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                                    <span class="btn-text">Place Order</span>
                                    <span class="btn-hover-text">Proceed to Checkout</span>
                                </button>
                            </div><!-- End .summary -->
                        </aside><!-- End .col-lg-3 -->
                    </div><!-- End .row -->
                </form>
            </div><!-- End .container -->
        </div><!-- End .checkout -->
    </div><!-- End .page-content -->
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('input[name="delivery_method"]').on('change', function () {
                let deliveryFee = $(this).data('fee');
                let totalPrice = {{ $totalPrice }};
                let total = totalPrice + deliveryFee;
                // number format
                total = total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                $('.summary-total td:last-child').text('৳' + total);
            });
        });
    </script>
@endsection
