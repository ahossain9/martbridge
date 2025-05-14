<?php

namespace App\Http\Controllers\Admin\UserManage;

use App\Constants\AdminConstant;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleController extends Controller
{
    public object $user;

    public function __construct()
    {
        $this->middleware('auth:admin');

        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard(AdminConstant::ADMIN_GUARD)->user();

            return $next($request);
        });
    }

    public function index()
    {
        if (! $this->user->can('role read')) {
            return redirect()->route('admin.unauthorized');
        }

        $roles = Role::all();
        $permissions = Permission::all();
        $permission_groups = Admin::getUserPermissionsGroups();

        return view('admin.pages.user-manage.roles.index',
            [
                'roles' => $roles,
                'permissions' => $permissions,
                'permission_groups' => $permission_groups,
            ]);
    }

    public function create()
    {
        if (! $this->user->can('role create')) {
            return redirect()->route('admin.unauthorized');
        }

        $roles = Role::paginate(10);
        $permissions = Permission::all();
        $permission_groups = Admin::getUserPermissionsGroups();

        return view('admin.pages.user-manage.roles.create', [
            'permission_groups' => $permission_groups,
            'roles' => $roles,
            'permissions' => $permissions,
        ]);
    }

    public function store(Request $request)
    {
        if (! $this->user->can('role create')) {
            return redirect()->route('admin.unauthorized');
        }

        $request->validate([
            'role_name' => 'required|max:50',
            'permissions' => 'array',
        ]);

        $existRoleName = Role::where('guard_name', 'admin')
            ->where('name', $request->admin_role_name)->first();

        if (($existRoleName)) {
            return back()->with('error', 'Role name already exist!');
        }
        try {
            $role = Role::create(
                [
                    'name' => $request->role_name,
                    'guard_name' => 'admin',
                ]);
            $permissions = $request->input('permissions');
            if (! empty($permissions)) {
                $role->syncPermissions($permissions);
            }

            app()->make(PermissionRegistrar::class)->forgetCachedPermissions();

            return back()->with('success', 'Role created successfully with the permissions.');
        } catch (Exception $exception) {
            return back()->with('error', 'Could not create a role, due to '.$exception->getMessage());
        }
    }

    public function edit($role_id)
    {
        if (! $this->user->can('role update')) {
            return redirect()->route('admin.unauthorized');
        }

        $role = Role::find($role_id);
        $permissions = Permission::all();
        $permission_groups = Admin::getUserPermissionsGroups();

        return view('admin.pages.user-manage.roles.edit',
            [
                'role' => $role,
                'permissions' => $permissions,
                'permission_groups' => $permission_groups,
            ]);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        if (! $this->user->can('role update')) {
            return redirect()->route('admin.unauthorized');
        }

        $request->validate([
            'role_name' => 'required|max:50',
            'permissions' => 'array',
        ]);

        $role = Role::find($id);
        $role->name = $request->role_name;
        $role->save();

        $permissions = $request->input('permissions');
        if (! empty($permissions)) {
            $role->syncPermissions($permissions);
        }
        app()->make(PermissionRegistrar::class)->forgetCachedPermissions();

        return back()->with('success', 'Role updated successfully with the permissions.');
    }

    public function destroy($id): RedirectResponse
    {
        if (! $this->user->can('role delete')) {
            return redirect()->route('admin.unauthorized');
        }

        $role = Role::find($id);
        $user = auth()->user();
        if ($user->hasRole('administrator') || $user->hasRole('superadmin')) {
            $role->delete();

            return back()->with('success', 'Role deleted successfully.');
        } else {
            return back()->with('error', 'You are not authorized to delete this role.');
        }
    }
}
