<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Helpers\CartHelper;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        // validate name, email, password
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'password' => 'required|string|min:8',
        ]);

        // create customer
        if (Customer::where('email', $validated['email'])->exists()) {
            toastr()->error('Email already exists', 'Registration');

            return back();
        }

        $customer = Customer::create([
            'first_name' => $validated['first_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        toastr()->success('Registration Successful ⚡️', 'Registration');

        Auth::login($customer);

        CartHelper::moveItemFromSessionToDB();

        return back();
    }
}
