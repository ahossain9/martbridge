@extends('admin.layouts.master')

@section('admin-title', 'Edit Permission')

@section('admin-content')
    <div class="content-body">
        <div class="d-flex justify-content-between mb-1">
            <h3>Edit Permission - <span class="badge bg-info">{{ $permission->name }}</span></h3>
            <a class="btn btn-outline-dark" href="{{ url()->previous() }}"> Back</a>
        </div>

        @include('admin.partials.message')

        <!-- Permission Table -->
        <div class="card">
            <div class="card-body">
                <form class="row" method="POST" action="{{ route('admin.user_manage.permissions.update', $permission) }}">
                    @csrf
                    @method('PUT')
                    <div class="col-md-6 col-sm-12">
                        <div class="mb-1">
                            <label class="form-label" for="permission_group_edit_name">
                                <strong>Permission Group</strong>
                            </label>
                            <input type="text" id="permission_group_edit_name" name="group_name" value="{{ $permission->group_name }}" class="form-control"
                                   placeholder="Group Name" autofocus data-msg="Please enter permission group name" required />
                        </div>

                        <label class="form-label" for="permission_names">
                            <strong>Permission Names</strong> <span class="font-small-1">Multiple permissions must separate with comma(,)</span>
                        </label>
                        <input type="text" id="permission_names" name="name" class="form-control" placeholder="Permission Name" autofocus data-msg="Please enter permission name" value="{{ $permission->name }}" required />

                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary mt-2 me-1">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('admin-scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#permission_table').DataTable({
                paging: false,
            });
        });
    </script>
@endsection
