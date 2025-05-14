@extends('admin.layouts.master')

@section('admin-title', 'Vendors')

@section('admin-content')
    <div class="content-body">
        <div class="d-flex justify-content-between">
            <div class="">
                <h3>Vendors - <span class="badge bg-primary">{{ $vendors->count() }}</span></h3>
            </div>
            <div class="">
                <a class="btn btn-primary" href="{{ route('admin.store.vendors.create') }}">Add New
                    Vendor</a>
            </div>
        </div>
        @include('admin.partials.message')

        <!-- Variant Table -->
        <div class="card">
            <div class="card-datatable table-responsive p-2">
                <table id="vendors_table" class="table table table-striped" style="width:100%">
                    <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Added by</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($vendors as $key => $vendor)
                        <tr>
                            <td>{{ $loop->index +1 }}</td>
                            <td>{{ $vendor->name }}</td>
                            <td>
                                @if($vendor->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>{{ $vendor->created_by }}</td>
                            <td>{{ \Illuminate\Support\Carbon::parse($vendor->updated_at)->diffForHumans() }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0"
                                            data-bs-toggle="dropdown">
                                        <i data-feather="more-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" data-bs-toggle="modal"
                                           data-bs-target="#addVariantOptionValue-{{ $vendor->id }}"
                                        >
                                        </a>

                                        <a class="dropdown-item"
                                           href="{{ route('admin.store.vendors.edit', $vendor) }}"
                                        >
                                            <i data-feather="edit-2" class="me-50"></i>
                                            <span>Edit</span>
                                        </a>

                                        <a class="dropdown-item" href="#"
                                           data-bs-toggle="modal"
                                           data-bs-target="#deleteVariantModal-{{ $vendor->id }}">
                                            <i data-feather="trash" class="me-50"></i>
                                            <span>Delete</span>
                                        </a>
                                    </div>
                                </div>
                                @include('admin.pages.vendors.delete')
                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
                <div class="float-end">
                    {{ $vendors->links() }}
                </div>
            </div>
        </div>
        <!--/ Variant Table -->

    </div>
@endsection

@section('admin-scripts')
    <script>
        $(document).ready(function () {
            $('#vendors_table').DataTable(
                {
                    paging: false,
                }
            );
        });

    </script>
@endsection
