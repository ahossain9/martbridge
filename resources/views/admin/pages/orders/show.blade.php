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

@extends('admin.layouts.master')

@section('admin-title', 'Preview Order')

@section('admin-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/pages/app-invoice.css') }}">
@endsection

@section('admin-content')
    <div class="content-body">
        <div class="d-flex justify-content-between">
            <div class="">
                <h3>Order Preview - #<span>{{ $order->order_number }}</span></h3>
            </div>
            <div class="mb-2">
                <a class="btn btn-primary" href="{{ route('admin.manage_orders.orders.index') }}" >Back</a>
            </div>
        </div>
        @include('admin.partials.message')
        <section class="invoice-preview-wrapper">
            <div class="row invoice-preview">
                <!-- Invoice -->
                <div class="col-xl-9 col-md-8 col-12">
                    <div class="card invoice-preview-card">
                        <div class="card-body invoice-padding pb-0">
                            <!-- Header starts -->
                            <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                                <div>
                                    <div class="logo-wrapper">
                                        <img src="{{ asset('admin-assets/images/logo/logo.png') }}" alt="" height="35">
                                        <h3 class="text-primary invoice-logo">{{ \App\Constants\AdminConstant::APP_NAME }}</h3>
                                    </div>
                                    <p class="card-text mb-25">29/3, Shukrabad</p>
                                    <p class="card-text mb-25">Dhaka-1207, Bangladesh</p>
                                    <p class="card-text mb-0">+880 168 880 34515</p>
                                </div>
                                <div class="mt-md-0 mt-2">
                                    <h4 class="invoice-title">
                                        Invoice
                                        <span class="invoice-number">#{{ $order->order_number }}</span>
                                    </h4>
                                    <div class="invoice-date-wrapper">
                                        <p class="invoice-date-title" style="width: auto">Date Issued:</p>
                                        <p class="invoice-date">{{ Carbon::parse($order->created_at)->format('d/m/Y') }}</p>
                                    </div>
                                    <div class="invoice-date-wrapper">
                                        <p class="invoice-date-title" style="width: auto">Expected Delivery Date:</p>
                                        <p class="invoice-date">
                                            {{ Carbon::parse($order->created_at)->addDays(3)->format('d/m/Y') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- Header ends -->
                        </div>

                        <hr class="invoice-spacing" />

                        <!-- Address and Contact starts -->
                        <div class="card-body invoice-padding pt-0">
                            <div class="row invoice-spacing">
                                <div class="col-xl-8 p-0">
                                    <h6 class="mb-2">Invoice To:</h6>
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
                                <div class="col-xl-4 p-0 mt-xl-0 mt-2">
                                    <h6 class="mb-2">Payment Details:</h6>
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

<!--                                        <tr>
                                            <td class="pe-1">Location:</td>
                                            <td><span class="fw-bold">{{ $delivery_location }}</span></td>
                                        </tr>-->

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Address and Contact ends -->

                        <!-- Invoice Description starts -->
                        <div class="table-responsive">
                            <table class="table">
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
                                        <td class="py-1">
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

                                        @foreach($item->attributes as $key => $val)
                                                @php
                                                $attr = \App\Models\ProductAttribute::find($key)->name ?? '';
                                                $value = \App\Models\ProductAttributeValue::find($val)->value ?? '';
                                                @endphp
                                                <p class="card-text text-nowrap">
                                                    {{ $attr }} : {{ $value }}
                                                </p>
                                            @endforeach
                                        </td>
                                        <td class="py-1">
                                            <span class="fw-bold">{{ CurrencyHelper::formatWithCurrencyAndSign($item->unit_price/100) }}</span>
                                        </td>
                                        <td class="py-1">
                                            <span class="fw-bold">{{ $item->quantity }}</span>
                                        </td>
                                        <td class="py-1">
                                            <span class="fw-bold">{{ CurrencyHelper::formatWithCurrencyAndSign(($item->unit_price * $item->quantity)/100) }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <hr>
                        <div class="card-body invoice-padding pb-0">
                            <div class="row invoice-sales-total-wrapper">
                                <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
<!--                                    <p class="card-text mb-0">
                                        <span class="fw-bold">Salesperson:</span> <span class="ms-75">Alfie Solomons</span>
                                    </p>-->
                                </div>
                                <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
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

                            <div class="row mt-2">
                                <div class="col-md-8">
                                    <form action="{{ route('admin.manage_orders.update.price', $order) }}" method="POST">
                                        @csrf
                                        <div class="mb-1">
                                            <label class="form-label" for="discount_price">Adjust/Discount price</label>
                                            <small><strong> Add negative(-) if you want to provide discount</strong></small>
                                            <input type="number" class="form-control" id="discount_price" name="discount_price" placeholder="Enter discount price" value="-0">
                                        </div>
                                        <button type="submit" class="btn btn-success waves-effect waves-float waves-light"> Adjust </button>
                                    </form>
                                </div>
                                <div class="col-md-6">

                                </div>
                            </div>

                        </div>
                        <!-- Invoice Description ends -->

                        <hr class="invoice-spacing" />

                        <!-- Invoice Note starts -->
                        <div class="card-body invoice-padding pt-0">
                            <div class="row">
                                <div class="col-12">
                                    <span class="fw-bold">Customer Says *:</span>
                                    <span>
                                        {{ $order->orderDetails->order_note }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- Invoice Note ends -->
                    </div>
                </div>
                <!-- /Invoice -->

                <!-- Invoice Actions -->
                <div class="col-xl-3 col-md-4 col-12 invoice-actions mt-md-0 mt-2">
                    <div class="card">
                        <div class="card-body">
                            <button class="btn btn-primary w-100 mb-75" data-bs-toggle="modal" data-bs-target="#send-invoice-sidebar">
                                Send Invoice
                            </button>
                            <button class="btn btn-outline-secondary w-100 btn-download-invoice mb-75">Download</button>
                            <a class="btn btn-outline-secondary w-100 mb-75" href="{{ route('admin.manage_orders.invoice.print', $order) }}" target="_blank"> Print </a>
                            <a class="btn btn-outline-secondary w-100 mb-75" href="#"> Edit </a>
                            <form action="{{ route('admin.manage_orders.update.status', $order) }}" method="POST">
                                @csrf
                                <label for="order_status">Order Status</label>
                                <div class="d-flex align-items-center justify-content-md-end mb-1">
                                    <div class="input-group input-group-merge invoice-edit-input-group">
                                        <select class="form-select" id="order_status" name="status">
                                            @foreach(\App\Helpers\OrderHelper::getOrderStatuses() as $key => $status)
                                                <option value="{{ $key }}" {{ $order->status == $key ? 'selected' : '' }}>{{ $status }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success w-100">
                                    Save
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /Invoice Actions -->
            </div>
        </section>

        <!-- Send Invoice Sidebar -->
        <div class="modal modal-slide-in fade" id="send-invoice-sidebar" aria-hidden="true">
            <div class="modal-dialog sidebar-lg">
                <div class="modal-content p-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                    <div class="modal-header mb-1">
                        <h5 class="modal-title">
                            <span class="align-middle">Send Invoice</span>
                        </h5>
                    </div>
                    <div class="modal-body flex-grow-1">
                        <form>
                            <div class="mb-1">
                                <label for="invoice-from" class="form-label">From</label>
                                <input type="text" class="form-control" id="invoice-from" name="from_mail" value="shipping@techstronix.com" placeholder="company@email.com" />
                            </div>
                            <div class="mb-1">
                                <label for="invoice-to" class="form-label">To</label>
                                <input type="text" class="form-control" id="invoice-to" name="to_mail" value="{{ $shipping->email }}" placeholder="company@email.com" />
                            </div>
                            <div class="mb-1">
                                <label for="invoice-subject" class="form-label">Subject</label>
                                <input type="text" class="form-control" id="invoice-subject" name="subject" value="Invoice of purchased Admin Templates" placeholder="Invoice regarding goods" />
                            </div>
                            <div class="mb-1">
                                <label for="invoice-message" class="form-label">Message</label>
                                <textarea class="form-control" name="invoice-message" id="invoice-message" cols="3" rows="11" placeholder="Message...">
                                    Dear Queen Consolidated,
                                    Please find attached the invoice for the goods we received from you.
                                </textarea>
                            </div>
                            <div class="mb-1">
                                        <span class="badge badge-light-primary">
                                            <i data-feather="link" class="me-25"></i>
                                            <span class="align-middle">Invoice Attached</span>
                                        </span>
                            </div>
                            <div class="mb-1 d-flex flex-wrap mt-2">
                                <button type="button" class="btn btn-primary me-1" data-bs-dismiss="modal">Send</button>
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Send Invoice Sidebar -->
    </div>
@endsection

@section('admin-scripts')
    <script src="{{ asset('admin-assets/js/scripts/pages/app-invoice.js') }}"></script>
@endsection
