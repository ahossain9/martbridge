@extends('admin.layouts.master')

@section('admin-title', 'Attribute Values')

@section('admin-content')
    <div class="content-body">
        <div class="d-flex justify-content-between">
            <div class="">
                <h3>Product Attributes - <span class="badge bg-primary">{{ $attributes->count() }}</span></h3>
                <p>Each attribute has many values.</p>
            </div>

            {{--            <div class="">--}}
            {{--                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductVariantModal">Add New Variant</button>--}}
            {{--            </div>--}}
            <div class="">
                <a class="btn btn-primary" href="{{ route('admin.product_manage.attributes.create') }}">Add New
                    Attribute</a>
            </div>
        </div>
        @include('admin.partials.message')

        {{--        @include('admin.pages.products.attributes.create')--}}

        <!-- Variant Table -->
        <div class="card">
            <div class="card-datatable table-responsive p-2">
                <table id="variant_dtable" class="table table table-striped" style="width:100%">
                    <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Name</th>
                        <th>Subcategory</th>
                        <th width="60%">Values</th>
                        <th>Added by</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($attributes as $key => $attribute)
                        <tr>
                            <td>{{ $loop->index +1 }}</td>
                            <td>{{ $attribute->name }}</td>
                            <td>{{ $attribute->subcategory->name }}</td>
                            <td>
                                @foreach($attribute->attribute_values as $value)
                                    <span class="badge bg-primary" style="margin-right: 3px;">{{ $value->name }}</span>
                                @endforeach
                            </td>
                            <td>{{ $attribute->created_by }}</td>
                            <td>{{ \Illuminate\Support\Carbon::parse($attribute->updated_at)->diffForHumans() }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0"
                                            data-bs-toggle="dropdown">
                                        <i data-feather="more-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" data-bs-toggle="modal"
                                           data-bs-target="#addVariantOptionValue-{{ $attribute->id }}"
                                        >
                                            <i data-feather="edit-2" class="me-50"></i>
                                            <span>Add Values</span>
                                        </a>
                                        {{--                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editProductVariantModal-{{$attribute->id}}"--}}
                                        {{--                                        >--}}
                                        {{--                                            <i data-feather="edit-2" class="me-50"></i>--}}
                                        {{--                                            <span>Edit</span>--}}
                                        {{--                                        </a>--}}

                                        <a class="dropdown-item"
                                           href="{{ route('admin.product_manage.attributes.edit', $attribute) }}"
                                        >
                                            <i data-feather="edit-2" class="me-50"></i>
                                            <span>Edit</span>
                                        </a>

                                        <a class="dropdown-item" href="#"
                                           data-bs-toggle="modal"
                                           data-bs-target="#deleteVariantModal-{{ $attribute->id }}">
                                            <i data-feather="trash" class="me-50"></i>
                                            <span>Delete</span>
                                        </a>
                                    </div>
                                </div>
                                <!-- Create Option Values Modal -->
                                {{--                                @include('admin.pages.products.attributes.create-option-values')--}}
                                <!--/ Edit Modal -->

                                <!-- Edit Modal -->
                                {{--                                @include('admin.pages.products.attributes.edit')--}}
                                <!--/ Edit Modal -->

                                <!-- Delete Modal -->
                                @include('admin.pages.products.attributes.delete')
                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
                <div class="float-end">
                    {{ $attributes->links() }}
                </div>
            </div>
        </div>
        <!--/ Variant Table -->

    </div>
@endsection

@section('admin-scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#variant_dtable').DataTable(
                {
                    paging: false,
                }
            );
        });

    </script>
@endsection
