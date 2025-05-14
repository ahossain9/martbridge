@extends('admin.layouts.master')

@section('admin-title', 'Product Sub Categories')

@section('admin-content')
    <div class="content-body">
        <div class="d-flex justify-content-between">
            <div class="">
                <h3>Product Sub Categories - <span class="badge bg-primary">{{ $product_sub_categories->count() }}</span></h3>
                <p>Each sub category is belongs to category.</p>
            </div>

            <div class="">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductSubCategoryModal">Add new Sub Category</button>
            </div>
        </div>
        @include('admin.partials.message')

        <!-- Product categories Table -->
        <div class="card">
            <div class="card-datatable table-responsive p-2">
                <table id="product_sub_categories_dtable" class="table table table-striped" style="width:100%">
                    <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Name</th>
                        <th>Product Category</th>
                        <th>Image</th>
                        <th>Home Page</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Added by</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($product_sub_categories as $key => $sub_category)
                        <tr>
                            <td>{{ $key +1 }}</td>
                            <td>{{ $sub_category->name }}</td>
                            <td>{{ $sub_category->product_category->name }}</td>
                            <td>
                                @if($sub_category->image)
                                    <img src="{{ \App\Helpers\FileManageHelper::getS3FileUrl($sub_category->image) }}" alt="{{ $sub_category->name }}"
                                         loading="lazy" width="100">

                                @else
                                    No Image
                                @endif
                            </td>
                            <td>
                                @if($sub_category->is_shown_to_home_page)
                                    <span class="badge bg-info">Activated</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>{{ $sub_category->slug }}</td>
                            <td>
                                @if($sub_category->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>{{ $sub_category->created_by }}</td>
                            <td>{{ \Illuminate\Support\Carbon::parse($sub_category->updated_at)->diffForHumans() }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                                        <i data-feather="more-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
<!--                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#add-variant-{{$sub_category->id}}"
                                        >
                                            <i data-feather="check-square" class="me-50"></i>
                                            <span>Add variant</span>
                                        </a>-->
                                        <a class="dropdown-item" href="{{ route('admin.product_manage.sub_categories.edit', $sub_category) }}"
                                        >
                                            <i data-feather="edit-2" class="me-50"></i>
                                            <span>Edit</span>
                                        </a>
                                        <a class="dropdown-item" href="#"
                                           data-bs-toggle="modal" data-bs-target="#subCategoryDeleteModal-{{ $sub_category->id }}">
                                            <i data-feather="trash" class="me-50"></i>
                                            <span>Delete</span>
                                        </a>
                                    </div>
                                </div>
                                <!-- Delete Modal -->
                                @include('admin.pages.products.sub-categories.delete')
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="float-end">
                    {{ $product_sub_categories->links() }}
                </div>
            </div>
        </div>
        <!--/ Product categories Table -->
        <!-- Add Create Modal -->
        @include('admin.pages.products.sub-categories.create')

        <!--/ Add Create Modal -->
    </div>
@endsection

@section('admin-scripts')
    <script>
        $(document).ready(function () {
            $('#product_sub_categories_dtable').DataTable(
                {
                    paging: false,
                }
            );
        });

    </script>
@endsection
