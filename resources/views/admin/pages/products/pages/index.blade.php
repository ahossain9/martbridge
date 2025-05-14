@extends('admin.layouts.master')

@section('admin-title', 'Product')

@section('admin-content')
    <div class="content-body">
        <div class="d-flex justify-content-between mb-1">
            <div class="">
                <h3>Product - <span class="badge bg-primary">{{ $productCount }}</span></h3>
            </div>
            <div class="">
                <a class="btn btn-primary" href="{{ route('admin.product_manage.products.create') }}" >Add New Product</a>
            </div>
        </div>
        @include('admin.partials.message')

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.product_manage.products.index') }}" method="GET">
                    <div class="row">
                        <div class="col-md-8 col-12">
                            <div class="form-group">
                                <label for="search-query" class="sr-only">Search from All products</label>
                                <input type="text" placeholder="search query" id="search-query" name="search-query"
                                       class="form-control" value="{{ $_GET['search-query'] ?? '' }}" required>
                            </div>
                        </div>

                        <div class="col-md-4 col-12" style="padding-top: 18px;">
                            <div class="">
                                <button type="submit" class="btn btn-primary me-1">Search</button>
                                <a href="{{ route('admin.product_manage.products.index') }}" class="btn btn-outline-dark">Clear Search</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Products Table -->
        <div class="card">
            <div class="card-datatable table-responsive p-2">
                <table id="products_d_table" class="table table table-striped" style="width:100%">
                    <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Subcategory</th>
                        <th>Feature Image</th>
                        <th>Base Price</th>
                        <th>Sale Price</th>
                        <th>Promo Price</th>
                        <th>Status</th>
                        <th>Added by</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                        <th>Others</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category_name }}</td>
                            <td>{{ $product->sub_category_name }}</td>
                            <td>
                                <img src="{{ \App\Helpers\FileManageHelper::getS3FileUrl($product->featured_image) }}" alt="{{ $product->name }}"
                                     loading="lazy" width="100">
                            </td>
{{--                            <td>--}}
{{--                                @foreach($product->variations as $variant)--}}
{{--                                    <span class="badge bg-primary">{{ $variant->name }}</span>--}}
{{--                                @endforeach--}}
{{--                            </td>--}}
                            <td>৳ {{ $product->value->base_price ?? 0 }}</td>
                            <td>৳ {{ $product->value->sale_price ?? 0 }}</td>
                            <td>৳ {{ $product->value->promo_price ?? 0 }}</td>
                            <td>
                                @if($product->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>{{ $product->added_by }}</td>
                            <td>{{ \Carbon\Carbon::parse($product->updated_at)->diffForHumans()  }}</td>
                            <td>
                                <a href="{{ route('admin.product_manage.products.edit', $product->id) }}" class="me-1"><i class="font-medium-4" data-feather='edit'></i></a>
                                <a href="#" data-bs-target="#deleteProductModal-{{ $product->id }}" data-bs-toggle="modal" class="text-danger"><i class="font-medium-4" data-feather='trash-2'></i></a>
                                @include('admin.pages.products.pages.partials.deleteModal')
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0"
                                            data-bs-toggle="dropdown">
                                        <i data-feather="more-vertical"></i>
                                    </button>

                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item"
                                       href="{{ route('admin.product_manage.products.duplicate', $product) }}"
                                    >
                                        <i data-feather="edit" class="me-50"></i>
                                        <span>Duplicate</span>
                                    </a>

                                </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="float-end">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
        <!--/ Products Table -->

    </div>
@endsection

@section('admin-scripts')
    <script>
        $(document).ready(function () {
            $('#products_d_table').DataTable(
                {
                    paging: false,
                    soring: false,
                }
            );
        });

    </script>
@endsection
