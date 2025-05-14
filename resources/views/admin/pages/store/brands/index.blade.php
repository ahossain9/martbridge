@extends('admin.layouts.master')

@section('admin-title', 'Brands')

@section('admin-content')
    <div class="content-body">
        <div class="d-flex justify-content-between mb-2">
            <div class="">
                <h3>Brands - <span class="badge bg-primary">{{ $brands->count() }}</span></h3>
            </div>
            <div class="">
                <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#addBrandCreateModal">Add New
                    Brand</a>
            </div>
        </div>
        @include('admin.partials.message')
        @include('admin.pages.store.brands.create-modal')

        <!-- Permission Table -->
        <div class="card">
            <div class="card-datatable table-responsive p-2">
                <table id="brand_group_table" class="table table table-striped" style="width:100%">
                    <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Updated by</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($brands as $key => $brand)
                        <tr>
                            <td>{{ $key + +1 }}</td>
                            <td>{{ $brand->name }}</td>
                            <td>{{ $brand->slug }}</td>
                            <td>
                                @if($brand->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>{{ $brand->updated_by ?? $brand->created_by }}</td>
                            <td>{{ \Illuminate\Support\Carbon::parse($brand->created_at)->diffForHumans() }}</td>
                            <td>{{ \Illuminate\Support\Carbon::parse($brand->updated_at)->diffForHumans() }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                                        <i data-feather="more-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="{{ route('admin.store.brands.edit', $brand) }}">
                                            <i data-feather="edit-2" class="me-50"></i>
                                            <span>Edit</span>
                                        </a>
                                        <a class="dropdown-item" href="#"
                                           data-bs-toggle="modal" data-bs-target="#deleteBrandModal-{{ $brand->id }}">
                                            <i data-feather="trash" class="me-50"></i>
                                            <span>Delete</span>
                                        </a>
                                    </div>
                                </div>
                                @include('admin.pages.store.brands.delete-modal')
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="float-end">
                    {{ $brands->links() }}
                </div>
            </div>
        </div>
        <!--/ Permission Table -->
    </div>
@endsection

@section('admin-scripts')
    <script>
        $(document).ready(function () {
            $('#brand_group_table').DataTable({
                paging: false,
            });
        });
    </script>
@endsection
