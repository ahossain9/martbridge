@extends('admin.layouts.master')

@section('admin-title', 'Product Categories')

@section('admin-content')
    <div class="content-body">
        <div class="d-flex justify-content-between">
            <div class="">
                <h3>Product Categories - <span class="badge bg-primary">{{ $productCategories->count() }}</span></h3>
                <p>Each category will define the product type and description.</p>
            </div>
            <div class="">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductCategoryModal">Add new Category</button>
            </div>
        </div>
        @include('admin.partials.message')

        <!-- Product categories Table -->
        <div class="card">
            <div class="card-datatable table-responsive p-2">
                <table id="product_categories_dtable" class="table table table-striped" style="width:100%">
                    <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Added by</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($productCategories as $key => $category)
                        <tr>
                            <td>{{ $key + +1 }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>
                                @if($category->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>{{ $category->created_by }}</td>
                            <td>{{ \Illuminate\Support\Carbon::parse($category->created_at)->diffForHumans() }}</td>
                            <td>{{ \Illuminate\Support\Carbon::parse($category->updated_at)->diffForHumans() }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                                        <i data-feather="more-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#categoryEditModal-{{$category->id}}"
                                        >
                                            <i data-feather="edit-2" class="me-50"></i>
                                            <span>Edit</span>
                                        </a>
                                        <a class="dropdown-item" href="#"
                                           data-bs-toggle="modal" data-bs-target="#categoryDeleteModal-{{ $category->id }}">
                                            <i data-feather="trash" class="me-50"></i>
                                            <span>Delete</span>
                                        </a>
                                    </div>
                                </div>
                                <!-- Edit Modal -->
                                @include('admin.pages.products.categories.edit')
                                <!--/ Edit Modal -->
                                <!-- Delete Modal -->
                                @include('admin.pages.products.categories.delete')
                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
                <div class="float-end">
                    {{ $productCategories->links() }}
                </div>
            </div>
        </div>
        <!--/ Product categories Table -->
        <!-- Add Create Modal -->
        @include('admin.pages.products.categories.create')

        <!--/ Add Create Modal -->

    </div>
@endsection

@section('admin-scripts')
    <script>
        $(document).ready(function () {
            $('#product_categories_dtable').DataTable(
                {
                    paging: false,
                }
            );
        });

    </script>
@endsection
