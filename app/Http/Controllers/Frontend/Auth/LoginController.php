<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Helpers\CartHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm(): View
    {
        return view('frontend.auth.pages.login');
    }

    public function login(Request $request): RedirectResponse
    {
        // validate email and password
        $validated = $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        // attempt to login
        if (Auth::attempt($validated)) {
            CartHelper::moveItemFromSessionToDB();

            $request->session()->regenerate();

            toastr()->success('Login Successful ⚡️', 'Login');

            return redirect()->intended(route('frontend.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        toastr()->success('Logout Successful ⚡️', 'Logout');

        return redirect()->route('frontend.dashboard');
    }
}
