@extends('admin.layouts.master')

@section('admin-title', 'Users')

@section('admin-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/vendors/css/forms/select/select2.min.css') }}">
@endsection

@section('admin-content')
    <div class="content-body">
        <div class="d-flex justify-content-between">
            <div class="">
                <h3>Users List</h3>
                <p>Who are access to the admin panel with their permissions.</p>
            </div>
            <div class="">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">Add new user</button>
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
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Added by</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($admin_users as $key => $user)
                        <tr>
                            <td>{{ $key + +1 }}</td>
                            <td>{{ $user->first_name .' '. $user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @foreach ($user->roles as $role)
                                    <span class="badge bg-secondary mr-1 mb-1">
                                                {{ $role->name }}
                                            </span>
                                @endforeach
                            </td>
                            <td>{{ $user->added_by }}</td>
                            <td>{{ $user->updated_at }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                                        <i data-feather="more-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="{{ route('admin.user_manage.users.edit', $user) }}">
                                            <i data-feather="edit-2" class="me-50"></i>
                                            <span>Edit</span>
                                        </a>
                                        <a class="dropdown-item" href="#"
                                           data-bs-toggle="modal" data-bs-target="#UserDeleteModal-{{ $user->id }}">
                                            <i data-feather="trash" class="me-50"></i>
                                            <span>Delete</span>
                                        </a>
                                    </div>
                                </div>
                                <!-- Delete Modal -->
                                @include('admin.pages.user-manage.users.delete-modal')
                            </td>
                        </tr>
                        <!-- User Edit Modal -->
                        @include('admin.pages.user-manage.users.edit-modal')

                    @endforeach
                    </tbody>
                </table>
                <div class="float-end">
                    {{ $admin_users->links() }}
                </div>
            </div>
        </div>
        <!--/ Permission Table -->
        <!-- Add Permission Modal -->
        @include('admin.pages.user-manage.users.add-modal')
        <!--/ Add Permission Modal -->
    </div>
@endsection

@section('admin-scripts')
    <script>
        $(document).ready(function () {
            $('#permission_group_table').DataTable({
                paging: false,
            });

            $('.select2').select2();
        });
    </script>
@endsection
