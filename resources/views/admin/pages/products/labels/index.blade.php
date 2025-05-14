@extends('admin.layouts.master')

@section('admin-title', 'Product Labels')

@section('admin-content')
    <div class="content-body">
        <div class="d-flex justify-content-between">
            <div class="">
                <h3>Product labels - <span class="badge bg-primary">{{ $productLabelsCount }}</span></h3>
                <p>Labels will be used in product creation page.</p>
            </div>
            <div class="">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductLabelModal">Add new Label</button>
            </div>
        </div>
        @include('admin.partials.message')

        <!-- Product categories Table -->
        <div class="card">
            <div class="card-datatable table-responsive p-2">
                <table id="product_labels_dtable" class="table table table-striped" style="width:100%">
                    <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Created by</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($labels as $key => $label)
                        <tr>
                            <td>{{ $key + +1 }}</td>
                            <td>{{ $label->name }}</td>
                            <td>
                                @if($label->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>{{ $label->created_by }}</td>
                            <td>{{ \Illuminate\Support\Carbon::parse($label->updated_at)->diffForHumans() }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                                        <i data-feather="more-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#labelEditModal-{{$label->id}}"
                                        >
                                            <i data-feather="edit-2" class="me-50"></i>
                                            <span>Edit</span>
                                        </a>
                                        <a class="dropdown-item" href="#"
                                           data-bs-toggle="modal" data-bs-target="#labelDeleteModal-{{ $label->id }}">
                                            <i data-feather="trash" class="me-50"></i>
                                            <span>Delete</span>
                                        </a>
                                    </div>
                                </div>
                                <!-- Delete Modal -->
                                <!-- Edit Modal -->
                                @include('admin.pages.products.labels.edit')
                                <!--/ Edit Modal -->
                                @include('admin.pages.products.labels.delete')
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="float-end">
                    {{ $labels->links() }}
                </div>
            </div>
        </div>
        <!--/ Product categories Table -->
        <!-- Add Create Modal -->
        @include('admin.pages.products.labels.create')

        <!--/ Add Create Modal -->

    </div>
@endsection

@section('admin-scripts')
    <script>
        $(document).ready(function () {
            $('#product_labels_dtable').DataTable(
                {
                    paging: false,
                }
            );
        });

    </script>
@endsection
