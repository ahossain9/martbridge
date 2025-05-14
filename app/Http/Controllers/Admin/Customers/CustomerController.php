<?php

namespace App\Http\Controllers\Admin\Customers;

use App\Constants\AdminConstant;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
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
        if (! $this->user->can('customer read')) {
            return redirect()->route('admin.unauthorized');
        }

        if (request()->has('search-query')) {
            $searchQuery = request()->get('search-query');

            $customers = Customer::where('first_name', 'like', '%'.$searchQuery.'%')
                ->orWhere('last_name', 'like', '%'.$searchQuery.'%')
                ->orWhere('phone', 'like', '%'.$searchQuery.'%')
                ->orWhere('email', 'like', '%'.$searchQuery.'%')
                ->orderBy('id', 'desc')
                ->paginate(20);
        } else {
            $customers = Customer::orderBy('id', 'desc')->paginate(20);
        }

        $count = Customer::count();

        return view('admin.pages.customers.index', [
            'customers' => $customers ?? [],
            'customerCount' => $count,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        if (! $this->user->can('customer destroy')) {
            return redirect()->route('admin.unauthorized');
        }

        $customer->delete();

        return back()->with('success', 'Customer deleted successfully');
    }
}
