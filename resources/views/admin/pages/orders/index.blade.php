@extends('admin.layouts.master')

@section('admin-title', 'Orders')

@section('admin-content')
    <div class="content-body">
        <div class="d-flex justify-content-between">
            <div class="">
                <h3>Orders - <span class="badge bg-primary">{{ $orders->count() }}</span></h3>
            </div>
            <div class="mb-1">
                <a class="btn btn-primary" href="{{ route('admin.manage_orders.orders.create') }}">Add New Product</a>
            </div>
        </div>
        @include('admin.partials.message')

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.manage_orders.orders.index') }}" method="GET">
                    <div class="row">
                        <div class="col-md-8 col-12">
                            <div class="form-group">
                                <label for="search-query" class="sr-only">Search from All Orders</label>
                                <input type="text" placeholder="search query" id="search-query" name="search-query"
                                       class="form-control" value="{{ $_GET['search-query'] ?? '' }}" required>
                            </div>
                        </div>

                        <div class="col-md-4 col-12" style="padding-top: 18px;">
                            <div class="">
                                <button type="submit" class="btn btn-primary me-1">Search</button>
                                <a href="{{ route('admin.manage_orders.orders.index') }}" class="btn btn-outline-dark">Clear
                                    Search</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Products Table -->
        <div class="card">
            <div class="card-datatable table-responsive p-2">
                <table id="orders_d_table" class="table table table-striped" style="width:100%">
                    <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Number</th>
                        <th>Customer</th>
                        <th>Status</th>
                        <th>Total Price</th>
                        <th>Delivery Method</th>
                        <th>Delivery Fee</th>
                        <th>Order Date</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ $order->customer->first_name }}</td>
                            <td>
                                @php
                                    /* Make color according to the order status */
                                    $order_status = $order->status;
                                    $order_status_color = '';
                                    if($order_status == 'pending'){
                                        $order_status_color = 'bg-warning';
                                    }elseif($order_status == 'processing'){
                                        $order_status_color = 'bg-info';
                                    }elseif($order_status == 'delivered'){
                                        $order_status_color = 'bg-success';
                                    }elseif($order_status == 'cancelled'){
                                        $order_status_color = 'bg-danger';
                                    }elseif($order_status == 'shipped'){
                                        $order_status_color = 'bg-primary';
                                    }
                                @endphp
                                <span class="badge {{ $order_status_color }}">{{ $order->status }}</span>
                            </td>
                            <td>৳{{ number_format($order->total_price/100, 2) }}</td>
                            <td>
                                @php
                                    $delivery_methods = config('delivery');
                                    $selected_delivery_method = $delivery_methods[$order->delivery_method];
                                    $delivery_label = $selected_delivery_method['label'];
                                    $delivery_cost = $selected_delivery_method['fee'];
                                @endphp
                                <span class="badge bg-primary">
                                    {{ $delivery_label }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-info">
                                    ৳ {{ $delivery_cost }}
                                </span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($order->created_at)->format('Y-m-d') }}</td>
                            <td>{{ \Carbon\Carbon::parse($order->updated_at)->diffForHumans()  }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.manage_orders.orders.edit', $order->id) }}" class="me-1"><i
                                            class="font-medium-4" data-feather='edit'></i></a>
                                    <a href="{{ route('admin.manage_orders.orders.show', $order->id) }}" class="me-1"><i
                                            class="font-medium-4" data-feather='eye'></i></a>
                                    <a href="#" data-bs-target="#deleteOrderModal-{{ $order->id }}"
                                       data-bs-toggle="modal"
                                       class="text-danger me-1"><i class="font-medium-4" data-feather='trash-2'></i></a>
                                    @include('admin.pages.orders.partials.deleteModal')
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="float-end">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
        <!--/ Products Table -->

    </div>
@endsection

@section('admin-scripts')
    <script>
        $(document).ready(function () {
            $('#orders_d_table').DataTable(
                {
                    paging: false,
                }
            );
        });

    </script>
@endsection
