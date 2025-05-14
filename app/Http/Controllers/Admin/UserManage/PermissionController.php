<?php

namespace App\Http\Controllers\Admin\UserManage;

use App\Constants\AdminConstant;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
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

    public function index(): Factory|View|Application|RedirectResponse
    {
        if (! $this->user->can('permission read')) {
            return redirect()->route('admin.unauthorized');
        }

        $permissions = Permission::orderBy('id', 'desc')->paginate(100);

        return view('admin.pages.user-manage.permissions.index',
            [
                'permissions' => $permissions,
            ]);
    }

    public function edit(string $id)
    {
        if (! $this->user->can('permission update')) {
            return redirect()->route('admin.unauthorized');
        }

        $permission = Permission::find($id);
        if (! $permission) {
            session()->flash('error', 'Permission not found');

            return back();
        }

        return view('admin.pages.user-manage.permissions.edit', [
            'permission' => $permission,
        ]);
    }

    public function store(Request $request)
    {
        if (! $this->user->can('permission create')) {
            return redirect()->route('admin.unauthorized');
        }

        $request->validate([
            'group_name' => 'required|string:max:40',
            'name' => 'required|unique:permissions',
        ]);

        // explode the permission names
        $permission_names = explode(',', $request->name);

        // loop through the permission names
        foreach ($permission_names as $permission_name) {
            // create the permission
            Permission::create([
                'name' => trim($permission_name),
                'guard_name' => 'admin',
                'group_name' => $request->group_name,
            ]);
        }
        session()->flash('success', 'Permission created successfully');

        return back();
    }

    public function update(Request $request, $id): RedirectResponse
    {
        if (! $this->user->can('permission update')) {
            return redirect()->route('admin.unauthorized');
        }

        $request->validate([
            'group_name' => 'required|string:max:40',
            'name' => 'required|unique:permissions,name,'.$id,
        ]);

        // find the permission
        $permission = Permission::find($id);

        // update the permission
        $permission->update([
            'name' => $request->name,
            'guard_name' => 'admin',
            'group_name' => $request->group_name,
        ]);

        session()->flash('success', 'Permission updated successfully');

        return back();
    }

    public function destroy($id): RedirectResponse
    {
        if (! $this->user->can('permission delete')) {
            return redirect()->route('admin.unauthorized');
        }

        // find the permission
        $permission = Permission::find($id);

        // delete the permission
        $permission->delete();

        session()->flash('success', 'Permission deleted successfully');

        return back();
    }
}
