@extends('admin.layouts.master')

@section('admin-title', 'Roles')

@section('admin-content')
    <div class="content-body">
        <h3>Roles List</h3>
        <p class="mb-2">
            A role provided access to predefined menus and features so that depending <br />
            on assigned role an administrator can have access to what he need
        </p>

        @include('admin.partials.message')
        <hr>

        <!-- Role cards -->
        <div class="row">
            @foreach($roles as $role)
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                @php
                                    $users = \App\Models\Admin::role($role->name)->get() ?? [];
                                @endphp

                                <span>Total {{ count($users) }} users</span>
                                <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Vinnie Mostowy" class="avatar avatar-sm pull-up">
                                        <img class="rounded-circle" src="{{ asset('admin-assets/images/avatars/2.png') }}" alt="Avatar" />
                                    </li>
                                </ul>
                            </div>
                            <div class="d-flex justify-content-between align-items-end mt-1 pt-25">
                                <div class="role-heading">
                                    <h4 class="fw-bolder">{{ $role->name }}</h4>
                                    <a href="{{ route('admin.user_manage.roles.edit', $role->id) }}"
                                        class="role-edit-modal mt-1">
                                        <small class="fw-bolder">
                                            <i data-feather="edit" class="font-medium-5">
                                            </i>
                                        </small>
                                    </a>
                                </div>

                                <a data-bs-target="#RoleDeleteModal-{{ $role->id }}" data-bs-toggle="modal">
                                    <span class="mb-1"><i data-feather="trash-2" class="font-medium-5"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @include('admin.pages.user-manage.roles.deleteModal')
            @endforeach
            <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="d-flex align-items-end justify-content-center h-100">
                                <img src="{{ asset('admin-assets/images/illustration/faq-illustrations.svg') }}" class="img-fluid mt-2" alt="Image" width="85" />
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="card-body text-sm-end text-center ps-sm-0">
                                <a href="{{ route('admin.user_manage.roles.create') }}" class="stretched-link text-nowrap add-new-role">
                                    <span class="btn btn-primary mb-1">Add New Role</span>
                                </a>
                                <p class="mb-0">Add role, if it does not exist</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Role cards -->

        <h3 class="mt-50">Total users with their roles</h3>
        <p class="mb-2">Find all of your company’s administrator accounts and their associate roles.</p>
        <!-- table -->
        <div class="card">
            <div class="table-responsive">
                <table class="user-list-table table">
                    <thead class="table-light">
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Plan</th>
                        <th>Billing</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="align-middle">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="user-checkbox1" />
                                <label class="form-check-label" for="user-checkbox1"></label>
                            </div>
                        </td>
                        <td class="align-middle">
                            <img src="{{ asset('admin-assets/images/avatars/1.png') }}" alt="Avatar" width="32" height="32" class="rounded-circle" />
                        </td>
                        <td class="align-middle">John Doe</td>
                        <td class="align-middle">Administrator</td>
                        <td class="align-middle">Free</td>
                        <td class="align-middle">Due on 15th Jan, 2021</td>
                        <td class="align-middle">
                            <span class="badge rounded-pill bg-light-success">Active</span>
                        </td>
                        <td class="align-middle">
                            <div class="dropdown">
                                <button class="btn btn-sm dropdown-toggle hide-arrow" type="button" id="dropdownMenuButton6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i data-feather="more-vertical"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton6">
                                    <a class="dropdown-item" href="javascript:void(0);"><i data-feather="edit-2" class="me-50"></i> Edit</a>
                                    <a class="dropdown-item" href="javascript:void(0);"><i data-feather="trash" class="me-50"></i> Delete</a>
                                    <a class="dropdown-item" href="javascript:void(0);"><i data-feather="archive" class="me-50"></i> Archive</a>
                                    <a class="dropdown-item" href="javascript:void(0);"><i data-feather="file-text" class="me-50"></i> Print</a>
                                    <a class="dropdown-item" href="javascript:void(0);"><i data-feather="download" class="me-50"></i> Download</a>
                                </div>
                            </div>
                        </td>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- table -->
        <!-- Add Role Modal -->
        <!--/ Add Role Modal -->

    </div>
@endsection

@section('admin-scripts')
    @include('admin.pages.user-manage.roles.scripts')
@endsection
