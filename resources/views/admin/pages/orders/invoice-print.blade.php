@php
use Carbon\Carbon;
use App\Helpers\CurrencyHelper;
use App\Helpers\ShippingHelper;

    $order = $order->load('customer.addresses');
    $shipping = $order->customer->addresses->first();
    $delivery_cost = ShippingHelper::getShippingFee($order->delivery_method);
    $delivery_method = ShippingHelper::getShippingLabel($order->delivery_method);
    $delivery_location = ShippingHelper::getShippingLabel($order->delivery_method);
    $sub_total = ($order->total_price) / 100;
    $total_due = CurrencyHelper::formatWithCurrencyAndSign($sub_total + $delivery_cost + ($order->discount_amount/100));

@endphp

@extends('admin.layouts.print')

@section('admin-title', 'Invoice')

@section('admin-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/pages/app-invoice-print.css') }}">
@endsection

@section('print-content')
    <body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="invoice-print p-3">
                    <div class="invoice-header d-flex justify-content-between flex-md-row flex-column pb-2">
                        <div>
                            <div class="d-flex mb-1">
                                <img src="{{ asset('admin-assets/images/logo/logo.png') }}" alt="" height="35">
                                <h3 class="text-primary fw-bold ms-1">{{ \App\Constants\AdminConstant::APP_NAME }}</h3>
                            </div>
                            <p class="card-text mb-25">29/3, Shukrabad</p>
                            <p class="card-text mb-25">Dhaka-1207, Bangladesh</p>
                            <p class="card-text mb-0">+880 168 880 34515</p>
                        </div>
                        <div class="mt-md-0 mt-2">
                            <h4 class="fw-bold text-end mb-1">INVOICE #{{ $order->order_number }}</h4>
                            <div class="invoice-date-wrapper mb-50">
                                <span class="invoice-date-title" style="width: auto">Date Issued:</span>
                                <span class="fw-bold"> {{ Carbon::parse($order->created_at)->format('d/m/Y') }}</span>
                            </div>
                            <div class="invoice-date-wrapper">
                                <span class="invoice-date-title" style="width: auto">Expected Delivery Date:</span>
                                {{ Carbon::parse($order->created_at)->addDays(3)->format('d/m/Y') }}
                            </div>
                        </div>
                    </div>

                    <hr class="my-2" />

                    <div class="row pb-2">
                        <div class="col-sm-6">
                            <h6 class="mb-1">Invoice To:</h6>
                            <h6 class="mb-25">{{ $shipping->first_name .' '. $shipping->last_name }}</h6>
                            <p class="card-text mb-25">
                                {{ $shipping->address }}
                                @if($shipping->address_2)
                                    , {{ $shipping->address_2 }}
                                @endif
                            </p>
                            <p class="card-text mb-25">
                                {{ $shipping->city }}
                                @if($shipping->state)
                                    , {{ $shipping->state }}
                                @endif

                                @if($shipping->zip)
                                    , {{ $shipping->zip }}
                                @endif

                                @if($shipping->country)
                                    , {{ $shipping->country }}
                                @endif
                            </p>
                            <p class="card-text mb-25">{{ $shipping->phone }}</p>
                            <p class="card-text mb-0">{{ $shipping->email }}</p>
                        </div>
                        <div class="col-sm-6 mt-sm-0 mt-2">
                            <h6 class="mb-1">Payment Details:</h6>
                            <table>
                                <tbody>
                                <tr>
                                    <td class="pe-1">Total Due:</td>
                                    <td><span class="fw-bold">{{ $total_due }}</span></td>
                                </tr>
                                <tr>
                                    <td class="pe-1">Method:</td>
                                    <td>{{ $delivery_method }}</td>
                                </tr>

<!--                                <tr>
                                    <td class="pe-1">Location:</td>
                                    <td><span class="fw-bold">{{ $delivery_location }}</span></td>
                                </tr>-->
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="table-responsive mt-2">
                        <table class="table m-0">
                            <thead>
                            <tr>
                                <th class="py-1">Product description</th>
                                <th class="py-1">Unit Price</th>
                                <th class="py-1">Quantity</th>
                                <th class="py-1">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->orderItems as $item)
                                <tr>
                                    <td class="py-1 ps-4">
                                        <p class="card-text fw-bold ">{{ $item->product->name }}
                                            @if($item->product->condition && $item->product->condition != 'null')
                                                <span class="badge badge-glow bg-primary">{{ ucfirst($item->product->condition) }}</span>
                                            @endif
                                        </p>

                                        @if($item['variants'])
                                            @foreach($item['variants'] as $varKey => $variant)
                                                <p style="margin-bottom: 0;">
                                                    <span class="fw-bolder">{{ $varKey }}:</span>
                                                    {{ $variant }}
                                                </p>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class="py-1">
                                        <strong>{{ CurrencyHelper::formatWithCurrencyAndSign($item->unit_price/100) }}</strong>
                                    </td>
                                    <td class="py-1">
                                        <strong>{{ $item->quantity }}</strong>
                                    </td>
                                    <td class="py-1">
                                        <strong>{{ CurrencyHelper::formatWithCurrencyAndSign(($item->unit_price * $item->quantity)/100) }}</strong>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="row invoice-sales-total-wrapper mt-3">
{{--                        <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">--}}
{{--                            <p class="card-text mb-0"><span class="fw-bold">Salesperson:</span> <span class="ms-75">Alfie Solomons</span></p>--}}
{{--                        </div>--}}
                        <div class="col-md-6 d-flex justify-content-center order-md-2">
                            <div class="invoice-total-wrapper">
                                <div class="invoice-total-item">
                                    <p class="invoice-total-title">Subtotal:</p>
                                    <p class="invoice-total-amount">{{ CurrencyHelper::formatWithCurrencyAndSign($order->total_price/100) }}</p>
                                </div>

                                @if($order->discount_amount)
                                    <div class="invoice-total-item">
                                        <p class="invoice-total-title">Discount:</p>
                                        <p class="invoice-total-amount">{{ CurrencyHelper::formatWithCurrencyAndSign($order->discount_amount/100) }}</p>
                                    </div>
                                @endif

                                <div class="invoice-total-item">
                                    <p class="invoice-total-title">Delivery:</p>
                                    <p class="invoice-total-amount">{{ CurrencyHelper::formatWithCurrencyAndSign($delivery_cost) }}</p>
                                </div>
                                <hr class="my-50" />
                                <div class="invoice-total-item">
                                    <p class="invoice-total-title">Total:</p>
                                    <p class="invoice-total-amount">{{ $total_due }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-2" />

                    <div class="row">
                        <div class="col-12">
                            <span class="fw-bold">Note:</span>
                            <span> If you have any questions concerning this invoice please contact us at <a href="mailto: contact@techstronix.com">contact@techstronix.com</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('admin-scripts')
    <script src="{{ asset('admin-assets/js/scripts/pages/app-invoice-print.js') }}"></script>
@endsection
