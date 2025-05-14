@extends('admin.layouts.master')

@section('admin-title', 'Permissions-Groups')

@section('admin-content')
    <div class="content-body">
        <div class="d-flex justify-content-between">
            <div class="">
                <h3>Permission Groups List</h3>
                <p>Each group will make the permission in a group filter, and it will contain permissions.</p>
            </div>
            <div class="">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPermissionGroupModal">Add new group</button>
            </div>
        </div>
        @include('admin.partials.message')

        <!-- Permission Table -->
        <div class="card">
            <div class="card-datatable table-responsive p-2">
                <table id="permission_group_table" class="table table table-striped" style="width:100%">
                    <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Added by</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($permission_groups as $key => $permission_group)
                        <tr>
                            <td>{{ $key + +1 }}</td>
                            <td>{{ $permission_group->name }}</td>
                            <td>{{ $permission_group->slug }}</td>
                            <td>{{ $permission_group->created_by }}</td>
                            <td>{{ \Illuminate\Support\Carbon::parse($permission_group->created_at)->diffForHumans() }}</td>
                            <td>{{ \Illuminate\Support\Carbon::parse($permission_group->updated_at)->diffForHumans() }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                                        <i data-feather="more-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#PermissionGroupEditModal-{{$permission_group->id}}"
                                        >
                                            <i data-feather="edit-2" class="me-50"></i>
                                            <span>Edit</span>
                                        </a>
                                        <a class="dropdown-item" href="#"
                                           data-bs-toggle="modal" data-bs-target="#PermissionGroupDeleteModal-{{ $permission_group->id }}">
                                            <i data-feather="trash" class="me-50"></i>
                                            <span>Delete</span>
                                        </a>
                                    </div>
                                </div>
                                @include('admin.pages.user-manage.permissions.groups.deleteGroupModal')
                            </td>
                        </tr>

                        <!-- Edit Permission Modal -->
                        <div class="modal fade" id="PermissionGroupEditModal-{{$permission_group->id}}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-transparent">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body px-sm-5 pb-5">
                                        <div class="text-center mb-2">
                                            <h1 class="mb-1">Edit Permission Group</h1>
                                            <p>Permissions group will group the permissions.</p>
                                        </div>
                                        <form id="addPermissionForm" class="row" method="POST" action="{{ route('admin.user_manage.permissions-groups.update', $permission_group) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="col-12">
                                                <label class="form-label" for="permission_group_name">Group Name</label>
                                                <input type="text" id="permission_group_name" name="name" class="form-control" placeholder="Permission Group Name" autofocus data-msg="Please enter group name" value="{{ $permission_group->name }}" required />
                                            </div>
                                            <div class="col-12 text-center">
                                                <button type="submit" class="btn btn-primary mt-2 me-1">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Edit Permission Modal -->

                    @endforeach
                    </tbody>
                </table>
                <div class="float-end">
                    {{ $permission_groups->links() }}
                </div>
            </div>
        </div>
        <!--/ Permission Table -->
        <!-- Add Permission Modal -->
        <div class="modal fade" id="addPermissionGroupModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-transparent">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-sm-5 pb-5">
                        <div class="text-center mb-2">
                            <h1 class="mb-1">Add New Permission Group</h1>
                            <p>Permissions group will group the permissions.</p>
                        </div>
                        <form id="addPermissionForm" class="row" method="POST" action="{{ route('admin.user_manage.permissions-groups.store') }}">
                            @csrf
                            <div class="col-12">
                                <label class="form-label" for="permission_group_name">Group Name</label>
                                <input type="text" id="permission_group_name" name="name" class="form-control" placeholder="Permission Group Name" autofocus data-msg="Please enter group name" required />
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary mt-2 me-1">Create Group</button>
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
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#permission_group_table').DataTable({
                paging: false,
            });
        });
    </script>
@endsection
