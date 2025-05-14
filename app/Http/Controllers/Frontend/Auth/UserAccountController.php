<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;

class UserAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = auth()->user()->orders;

        return view('frontend.auth.pages.user.account', [
            'orders' => $orders,
        ]);
    }
}
