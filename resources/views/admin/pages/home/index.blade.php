@extends('admin.layouts.master')

@section('admin-title') Dashboard @endsection

@section('admin-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/vendors/css/charts/apexcharts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/plugins/charts/chart-apex.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/pages/dashboard-ecommerce.css') }}">

@endsection

@section('admin-content')
    <div class="content-body">
        <!-- Dashboard Ecommerce Starts -->
        <section id="dashboard-ecommerce">
            <div class="row match-height">
                <!-- Medal Card -->
                <div class="col-xl-4 col-md-6 col-12">
                    <div class="card card-congratulation-medal">
                        <div class="card-body">
                            <h5>Hey 🎉 {{ auth('admin')->user()->first_name }}!</h5>
                            <p class="card-text font-small-3">Total sale of your store</p>
                            <h3 class="mb-75 mt-2 pt-50">
                                <a href="#">{{ currency() .makeHumanize((int) $totalSale/100.00) }}</a>
                            </h3>
                            <a href="{{ route('admin.manage_orders.orders.index') }}" class="btn btn-primary">View Sales</a>
                        </div>
                    </div>
                </div>
                <!--/ Medal Card -->

                <!-- Statistics Card -->
                <div class="col-xl-8 col-md-6 col-12">
                    <div class="card card-statistics">
                        <div class="card-header">
                            <h4 class="card-title">Statistics</h4>
                            <div class="d-flex align-items-center">
{{--                                <p class="card-text font-small-2 me-25 mb-0">Updated 1 month ago</p>--}}
                            </div>
                        </div>
                        <div class="card-body statistics-body">
                            <div class="row">
                                <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                    <div class="d-flex flex-row">
                                        <div class="avatar bg-light-primary me-2">
                                            <div class="avatar-content">
                                                <i data-feather="trending-up" class="avatar-icon"></i>
                                            </div>
                                        </div>
                                        <div class="my-auto">
                                            <h4 class="fw-bolder mb-0">{{ makeHumanize($totalSale/100.00) }}</h4>
                                            <p class="card-text font-small-3 mb-0">Sales</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                    <div class="d-flex flex-row">
                                        <div class="avatar bg-light-info me-2">
                                            <div class="avatar-content">
                                                <i data-feather="user" class="avatar-icon"></i>
                                            </div>
                                        </div>
                                        <div class="my-auto">
                                            <h4 class="fw-bolder mb-0">{{ makeHumanize($totalCustomer) }}</h4>
                                            <p class="card-text font-small-3 mb-0">Customers</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                                    <div class="d-flex flex-row">
                                        <div class="avatar bg-light-danger me-2">
                                            <div class="avatar-content">
                                                <i data-feather="box" class="avatar-icon"></i>
                                            </div>
                                        </div>
                                        <div class="my-auto">
                                            <h4 class="fw-bolder mb-0">{{ makeHumanize($totalProducts) }}</h4>
                                            <p class="card-text font-small-3 mb-0">Products</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-sm-6 col-12">
                                    <div class="d-flex flex-row">
                                        <div class="avatar bg-light-success me-2">
                                            <div class="avatar-content">
                                                <i data-feather="dollar-sign" class="avatar-icon"></i>
                                            </div>
                                        </div>
                                        <div class="my-auto">
                                            <h4 class="fw-bolder mb-0">{{ currency() . makeHumanize((int) $totalRevenue) }}</h4>
                                            <p class="card-text font-small-3 mb-0">Revenue</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Statistics Card -->
            </div>

            <div class="row match-height">
                <div class="col-lg-4 col-12">
                    <div class="row match-height">
                        <!-- Bar Chart - Orders -->
                        <div class="col-lg-6 col-md-3 col-6">
                            <div class="card">
                                <div class="card-body pb-50">
                                    <h6>Orders</h6>
                                    <h2 class="fw-bolder mb-1">{{ makeHumanize($totalOrder) }}</h2>
                                    <div id="statistics-order-chart"></div>
                                </div>
                            </div>
                        </div>
                        <!--/ Bar Chart - Orders -->

                        <!-- Line Chart - Profit -->
                        <div class="col-lg-6 col-md-3 col-6">
                            <div class="card card-tiny-line-stats">
                                <div class="card-body pb-50">
                                    <h6>Profit</h6>
                                    <h2 class="fw-bolder mb-1">N/A</h2>
                                    <div id="statistics-profit-chart"></div>
                                </div>
                            </div>
                        </div>
                        <!--/ Line Chart - Profit -->

                        <!-- Earnings Card -->
                        <div class="col-lg-12 col-md-6 col-12">
                            <div class="card earnings-card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <h4 class="card-title mb-1">Earnings</h4>
                                            <div class="font-small-2">This Month</div>
                                            <h5 class="mb-1">{{ currency() . makeHumanize($totalEarningsOfThisMonth) }}</h5>
                                            <p class="card-text text-muted font-small-2">
                                                <span class="fw-bolder">{{ $earningPercentage }}%</span><span> more earnings than last month.</span>
                                            </p>
                                        </div>
                                        <div class="col-6">
<!--                                            <div id="earnings-chart"></div>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Earnings Card -->
                    </div>
                </div>

                <div class="col-lg-8 col-12">
                    <div class="card card-company-table">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Company</th>
                                        <th>Category</th>
                                        <th>Products</th>
                                        <th>Sales</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($vendors as $vendor)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar rounded">
                                                        <div class="avatar-content">
                                                            <img src="{{ asset('admin-assets/images/icons/toolbox.svg') }}" alt="Toolbar svg" />
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="fw-bolder">{{ $vendor->name }}</div>
                                                        <div class="font-small-2 text-muted">{{ $vendor->email ?? '' }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar bg-light-primary me-1">
                                                        <div class="avatar-content">
                                                            <i data-feather="monitor" class="font-medium-3"></i>
                                                        </div>
                                                    </div>
                                                    <span>Technology</span>
                                                </div>
                                            </td>
                                            <td class="text-nowrap">
                                                <div class="d-flex flex-column">
                                                    <span class="fw-bolder mb-25">{{ \App\Models\Product::query()->where('vendor_id', $vendor->id)->count() ?? 0 }}</span>
                                                    <span class="font-small-2 text-muted"></span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
{{--                                                    <span class="fw-bolder me-1">88%</span>--}}
                                                    <i data-feather="trending-up" class="text-success font-medium-1"></i>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card row">
                <div class="col-md-4 col-12 mb-2">
                    <best-selling-product-pie></best-selling-product-pie>
                </div>
            </div>

        </section>
        <!-- Dashboard Ecommerce ends -->
    </div>
@endsection

@section('admin-scripts')
    <script src="{{ asset('admin-assets/js/scripts/pages/dashboard-ecommerce.js') }}"></script>
@endsection
