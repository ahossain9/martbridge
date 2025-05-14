@extends('frontend.layouts.app')

@section('title', 'My Account')

@section('page-content')
    <div class="page-header text-center" style="background-image: url({{ asset('frontend/assets/images/page-header-bg.jpg') }})">
        <div class="container">
            <h1 class="page-title">My Account<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Account</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <div class="row">
                    <aside class="col-md-4 col-lg-3">
                        <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="tab-dashboard-link" data-toggle="tab" href="#tab-dashboard" role="tab" aria-controls="tab-dashboard" aria-selected="true">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-orders-link" data-toggle="tab" href="#tab-orders" role="tab" aria-controls="tab-orders" aria-selected="false">Orders</a>
                            </li>

<!--                            <li class="nav-item">
                                <a class="nav-link" id="tab-address-link" data-toggle="tab" href="#tab-address" role="tab" aria-controls="tab-address" aria-selected="false">Adresses</a>
                            </li>-->
                            <li class="nav-item">
                                <a class="nav-link" id="tab-account-link" data-toggle="tab" href="#tab-account" role="tab" aria-controls="tab-account" aria-selected="false">Account Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Sign Out</a>
                            </li>
                        </ul>
                    </aside><!-- End .col-lg-3 -->

                    <div class="col-md-8 col-lg-9">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab-dashboard" role="tabpanel" aria-labelledby="tab-dashboard-link">
                                <p>Hello <span class="font-weight-normal text-dark">{{ $customer->full_name() }}</span> (not <span class="font-weight-normal text-dark">{{ $customer->full_name() }}</span>? <a href="#">Log out</a>)
                                    <br>
                                    From your account dashboard you can view your <a href="#tab-orders" class="tab-trigger-link link-underline">recent orders</a>, manage your <a href="#tab-address" class="tab-trigger-link">shipping and billing addresses</a>, and <a href="#tab-account" class="tab-trigger-link">edit your password and account details</a>.</p>
                            </div>

                            <div class="tab-pane fade" id="tab-orders" role="tabpanel" aria-labelledby="tab-orders-link">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <table class="table table-cart table-mobile">
                                            <thead>
                                            <tr>
                                                <th>Sl</th>
                                                <th>Product</th>
                                                <th>Status</th>
                                                <th>Total</th>
                                            </tr>
                                            </thead>

                                            <tbody>

                                            @foreach($orders as $order)
                                                <tr>
                                                    <td class="price-col">
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td class="product-col">
                                                        @foreach($order->orderItems as $item)
                                                            @if($item->product)
                                                                <h3 class="product-title">
                                                                    <a href="{{ route('frontend.shop.product', $item->product->slug) }}">
                                                                        {{ $item->product->name . '(' . $item->quantity .'x ৳'. round($item->unit_price / 100.00) .')' }}</a>
                                                                </h3>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td class="price-col">
                                                        <span class="badge badge-success">{{ $order->status }}</span>
                                                    </td>
                                                    <td class="total-col">
                                                        @php
                                                            $deliveryCost = \App\Helpers\ShippingHelper::getShippingFee($order->delivery_method);
                                                            $totalPrice = ($order->total_price / 100.00) + $deliveryCost;

                                                        @endphp
                                                        ৳{{ number_format($totalPrice, 2) }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div><!-- End .row -->

                               @if(count($orders) == 0)
                                    <p>No order has been made yet.</p>
                                    <a href="{{ route('frontend.shop.index') }}" class="btn btn-outline-primary-2"><span>GO SHOP</span><i class="icon-long-arrow-right"></i></a>
                               @endif
                            </div><!-- .End .tab-pane -->

                            <div class="tab-pane fade" id="tab-address" role="tabpanel" aria-labelledby="tab-address-link">
                                <p>The following addresses will be used on the checkout page by default.</p>

                                <livewire:user-account-address wire:key="user-account-address" />

                                <hr class="mb-4">
                            </div><!-- .End .tab-pane -->

                            @include('frontend.auth.pages.user.account-details')
                        </div>
                    </div><!-- End .col-lg-9 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .dashboard -->
    </div><!-- End .page-content -->
@endsection
