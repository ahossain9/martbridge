@extends('admin.layouts.master')

@section('admin-title', 'Edit Role')

@section('admin-content')
    <div class="content-body">
        <h3>Edit Role - <span class="badge-light-info">{{ $role->name }}</span></h3>
        <p class="mb-2">
            A role provided access to predefined menus and features so that depending <br />
            on assigned role an administrator can have access to what he need
        </p>

        @include('admin.partials.message')
        <hr>

        <!-- Role cards -->
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.user_manage.roles.update', $role) }}" class="row" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="col-12">
                            <label class="form-label" for="modalRoleName">Role Name</label>
                            <input type="text" id="modalRoleName" name="role_name" class="form-control"  value="{{ $role->name }}" placeholder="Enter role name" tabindex="-1" data-msg="Please enter role name" />
                        </div>
                        <div class="col-12">
                            <h4 class="mt-2 pt-50">Role Permissions</h4>
                            <!-- Permission table -->
                            <div class="table-responsive">
                                <table class="table table-flush-spacing">
                                    <tbody>
                                    <tr>
                                        <td class="text-nowrap fw-bolder">
                                            Administrator Access
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Allows a full access to the system">
                                                                <i data-feather="info"></i></span>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="check_all_permissions"
                                                    {{ App\Models\Admin::roleHasPermissions($role, $permissions) ? 'checked': ''}}
                                                />
                                                <label class="form-check-label" for="check_all_permissions"> Select All </label>
                                            </div>
                                        </td>
                                    </tr>
                                    @php $i = 1; @endphp
                                    @foreach($permission_groups as $key => $group)
                                        @php $group_permissions = \App\Models\Admin::getUserPermissionsByGroupName($group->name) @endphp
                                        <tr>
                                            <td class="text-nowrap fw-bolder">{{ $group->name }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="form-check me-25 me-lg-5">
                                                        <input class="form-check-input" type="checkbox" id="check_all_permission_row-{{ $key }}"
                                                               onclick="checkPermissionsCreateByGroup('check-all-permission-in-row-{{ $key }}', this)"
                                                            {{ App\Models\Admin::roleHasPermissions($role, $group_permissions) ? 'checked': ''}}
                                                        />
                                                        <label class="form-check-label" for="check_all_permission_row-{{ $key }}">  </label>
                                                    </div>
                                                    <div class="check-all-permission-in-row-{{ $key }}">
                                                        @foreach($group_permissions as $permission)
                                                            <div class="form-check me-3 me-lg-5">
                                                                <input class="form-check-input" type="checkbox" name="permissions[]" id="permissions-{{ $permission->id }}"
                                                                       value="{{ $permission->name }}"
                                                                       onclick="checkCreateSinglePermission('check-all-permission-in-row-{{ $key }}', 'check_all_permission_row-{{ $key }}', '{{ count($permissions) }}')"
                                                                    {{ App\Models\Admin::roleHasPermissions($role, [$permission]) ? 'checked': ''}}
                                                                />
                                                                <label class="form-check-label" for="permissions-{{ $permission->id }}"> {{ $permission->name }} </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Permission table -->
                        </div>
                        <hr/>
                        <div class="col-12 mt-2">
                            <button type="submit" class="btn btn-primary me-1">Update</button>
                            <a href="{{ route('admin.user_manage.roles.index') }}" class="btn btn-outline-info">
                                Back
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--/ Role cards -->
    </div>
@endsection

@section('admin-scripts')
    @include('admin.pages.user-manage.roles.scripts')
@endsection
