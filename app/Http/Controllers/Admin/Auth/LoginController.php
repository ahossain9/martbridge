<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;

class LoginController extends Controller
{
    public function showAdminLoginForm(): Factory|View|Application
    {
        return view('admin.auth.pages.login');
    }

    public function adminLogin(AdminLoginRequest $request): \Illuminate\Http\RedirectResponse
    {
        $request->validated();
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (auth()->guard('admin')->attempt($credentials, $remember)) {
            auth()->guard('admin')->user()->update(['is_online' => true]);

            return redirect()->intended(route('admin.dashboard'));
        }

        // show credentials error
        session()->flash('error', 'Credentials do not match');

        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function adminLogout(): \Illuminate\Http\RedirectResponse
    {
        // set the is_active to false
        auth()->guard('admin')->user()->update(
            [
                'is_online' => false,
                'last_login_at' => Carbon::now(),
            ]
        );
        auth()->guard('admin')->logout();
        session()->flush();

        return redirect()->route('admin.auth.login');
    }
}
