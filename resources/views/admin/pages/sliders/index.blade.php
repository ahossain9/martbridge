@extends('admin.layouts.master')

@section('admin-title', 'Sliders')

@section('admin-content')
    <div class="content-body">
        <div class="d-flex justify-content-between">
            <div class="">
                <h3>Sliders - <span class="badge bg-primary">{{ $sliders->count() }}</span></h3>
            </div>
            <div class="">
                <a class="btn btn-primary" href="{{ route('admin.sliders.create') }}">Add New
                    Slider</a>
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
                        <th>Image</th>
                        <th>Status</th>
                        <th>Priority</th>
                        <th>Added by</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sliders as $key => $slider)
                        <tr>
                            <td>{{ $loop->index +1 }}</td>
                            <td>{{ $slider->name }}</td>
                            <td>
                                <img src="{{ \App\Helpers\FileManageHelper::getS3FileUrl($slider->image) }}" alt="{{ $slider->name }}"
                                     loading="lazy" width="100">
                            </td>
                            <td>
                                @if($slider->status == 1)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>{{ $slider->priority }}</td>
                            <td>{{ $slider->created_by }}</td>
                            <td>{{ \Illuminate\Support\Carbon::parse($slider->updated_at)->diffForHumans() }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0"
                                            data-bs-toggle="dropdown">
                                        <i data-feather="more-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" data-bs-toggle="modal"
                                           data-bs-target="#addVariantOptionValue-{{ $slider->id }}"
                                        >
                                        </a>

                                        <a class="dropdown-item"
                                           href="{{ route('admin.sliders.edit', $slider) }}"
                                        >
                                            <i data-feather="edit-2" class="me-50"></i>
                                            <span>Edit</span>
                                        </a>

                                        <a class="dropdown-item" href="#"
                                           data-bs-toggle="modal"
                                           data-bs-target="#deleteSliderModal-{{ $slider->id }}">
                                            <i data-feather="trash" class="me-50"></i>
                                            <span>Delete</span>
                                        </a>
                                    </div>
                                </div>
                                @include('admin.pages.sliders.delete')
                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
                <div class="float-end">
                    {{ $sliders->links() }}
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
