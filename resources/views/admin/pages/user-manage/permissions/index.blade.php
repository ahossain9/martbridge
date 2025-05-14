@extends('admin.layouts.master')

@section('admin-title', 'Permissions')

@section('admin-content')
    <div class="content-body">
        <div class="d-flex justify-content-between">
            <div class="">
                <h3>Permissions List</h3>
                <p>Each category (Basic, Professional, and Business) includes the four predefined roles shown below.</p>
            </div>
            <div class="">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPermissionModal">Add new permission</button>
            </div>
        </div>

        @include('admin.partials.message')

        <!-- Permission Table -->
        <div class="card">
            <div class="card-datatable table-responsive p-2">
                <table id="permission_table" class="table table table-striped" style="width:100%">
                    <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Permission Group</th>
                        <th>Name</th>
                        <th>Guard Name</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($permissions as $key => $permission)
                        <tr>
                            <td>{{ $key + +1 }}</td>
                            <td>{{ $permission->group_name }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->guard_name }}</td>
                            <td>{{ \Illuminate\Support\Carbon::parse($permission->created_at)->diffForHumans() }}</td>
                            <td>{{ \Illuminate\Support\Carbon::parse($permission->updated_at)->diffForHumans() }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                                        <i data-feather="more-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="{{ route('admin.user_manage.permissions.edit', $permission) }}">
                                            <i data-feather="edit-2" class="me-50"></i>
                                            <span>Edit</span>
                                        </a>
                                        <a class="dropdown-item" href="#"
                                           data-bs-toggle="modal" data-bs-target="#PermissionDeleteModal-{{ $permission->id }}">
                                            <i data-feather="trash" class="me-50"></i>
                                            <span>Delete</span>
                                        </a>
                                    </div>
                                </div>

                                <!-- Delete Modal -->
                                <div class="modal fade modal-danger text-start" id="PermissionDeleteModal-{{ $permission->id }}" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myModalLabel120">!!! Delete Confirmation !!!  <span class="badge badge-glow bg-warning">{{ $permission->name }}</span></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are your sure to delete this permission? It won't be able to recover.
                                            </div>
                                            <div class="modal-footer">
                                                <a href="" class="btn btn-danger"
                                                   onclick="event.preventDefault(); document.getElementById('delete-form-{{ $permission }}').submit();"
                                                >Yes, Delete</a>

                                                <form id="delete-form-{{ $permission }}" action="{{ route('admin.user_manage.permissions.destroy', $permission) }}" method="POST" style="display: none;">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="float-end">
                    {{ $permissions->links() }}
                </div>
            </div>
        </div>
        <!--/ Permission Table -->
        <!-- Add Permission Modal -->
        <div class="modal fade" id="addPermissionModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-transparent">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-sm-5 pb-5">
                        <div class="text-center mb-2">
                            <h1 class="mb-1">Add New Permission</h1>
                            <p>Permissions you may use and assign to your users.</p>
                        </div>
                        <form id="addPermissionForm" class="row" method="POST" action="{{ route('admin.user_manage.permissions.store') }}">
                            @csrf
                            <div class="col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="permission_group">
                                        <strong>Permission Group Name</strong>
                                    </label>
                                    <input type="text" id="group_name" name="group_name" class="form-control" placeholder="Permission Group Name" autofocus data-msg="Please enter permission group name" required />
                                </div>

                                <label class="form-label" for="permission_names">
                                    <strong>Permission Names</strong> <span class="font-small-1">Multiple permissions must separate with comma(,)</span>
                                </label>
                                <input type="text" id="permission_names" name="name" class="form-control" placeholder="Permission Name" autofocus data-msg="Please enter permission name" required />
                            </div>

                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary mt-2 me-1">Create Permission</button>
                                <button type="reset" class="btn btn-outline-secondary mt-2" data-bs-dismiss="modal" aria-label="Close">
                                    Discard
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Add Permission Modal -->

    </div>
@endsection

@section('admin-scripts')
    <script>
        $(document).ready(function () {
            $('#permission_table').DataTable({
                paging: false,
            });
        });
    </script>
@endsection
