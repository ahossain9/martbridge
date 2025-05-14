<?php

namespace App\Http\Controllers\Admin\UserManage;

use App\Constants\AdminConstant;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class AdminUserController extends Controller
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
        if (! $this->user->can('admin read')) {
            return redirect()->route('admin.unauthorized');
        }

        $admin_users = Admin::paginate(10);
        $roles = Role::all();

        return view('admin.pages.user-manage.users.index', [
            'admin_users' => $admin_users,
            'roles' => $roles,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        if (! $this->user->can('admin create')) {
            return redirect()->route('admin.unauthorized');
        }

        $request->validate([
            'first_name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6',
            'roles' => 'required|array',
        ]);

        try {
            $admin = Admin::create([
                'first_name' => $request->first_name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'added_by' => \auth()->guard('admin')->user()->email,
            ]);

            $admin->assignRole($request->roles);

            app()->make(PermissionRegistrar::class)->forgetCachedPermissions();

            return back()->with('success', 'Admin User Created Successfully !');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        if (! $this->user->can('admin update')) {
            return redirect()->route('admin.unauthorized');
        }

        $admin_user = Admin::find($id);
        $roles = Role::all();

        return view('admin.pages.user-manage.users.edit', [
            'user' => $admin_user,
            'roles' => $roles,
        ]);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        if (! $this->user->can('admin update')) {
            return redirect()->route('admin.unauthorized');
        }

        $request->validate([
            'first_name' => 'required',
            'email' => 'required|email|unique:admins,email,'.$id,
            'user_roles' => 'required|array',
        ]);

        try {
            $admin = Admin::find($id);
            $admin->first_name = $request->first_name;
            $admin->email = $request->email;

            if (! empty($request->password)) {
                $admin->password = bcrypt($request->password);
            }

            $admin->updated_by = \auth()->guard('admin')->user()->email;
            $admin->updated_at = Carbon::now();

            $admin->update();

            $admin->syncRoles($request->user_roles);

            app()->make(PermissionRegistrar::class)->forgetCachedPermissions();

            return back()->with('success', 'Admin User Updated Successfully !');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id): RedirectResponse
    {
        if (! $this->user->can('admin delete')) {
            return redirect()->route('admin.unauthorized');
        }

        try {
            $admin = Admin::find($id);
            $admin->delete();
            app()->make(PermissionRegistrar::class)->forgetCachedPermissions();

            return back()->with('success', 'Admin User Deleted Successfully !');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
