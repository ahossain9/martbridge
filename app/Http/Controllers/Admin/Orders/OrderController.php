<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Constants\AdminConstant;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
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
        if (! $this->user->can('order read')) {
            return redirect()->route('admin.unauthorized');
        }

        if (request()->has('search-query')) {
            $searchQuery = request()->get('search-query');

            $orders = Order::query()->with('customer')
                ->where('order_number', 'like', '%'.$searchQuery.'%')
                ->orWhereHas('customer', function ($query) use ($searchQuery) {
                    $query->where('first_name', 'like', '%'.$searchQuery.'%');
                    $query->orWhere('last_name', 'like', '%'.$searchQuery.'%');
                    $query->orWhere('email', 'like', '%'.$searchQuery.'%');
                    $query->orWhere('phone', 'like', '%'.$searchQuery.'%');
                })
                ->orderBy('created_at', 'desc')
                ->paginate(20);

        } else {
            $orders = Order::query()->with('customer')
                ->orderBy('created_at', 'desc')
                ->paginate(20);
        }

        return view('admin.pages.orders.index', [
            'orders' => $orders ?? [],
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
    public function show(Order $order)
    {
        if (! $this->user->can('order read')) {
            return redirect()->route('admin.unauthorized');
        }

        return view('admin.pages.orders.show', [
            'order' => $order,
        ]);
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
    public function destroy(string $id)
    {
        $order = Order::query()->findOrFail($id);

        if (! $order) {
            return redirect()->back()->with('error', 'Order not found');
        }

        try {
            $order->delete();

            return redirect()->back()->with('success', 'Order deleted successfully');
        } catch (Exception $e) {
            Log::info('Order deletion failed to: '.$e->getMessage());

            return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function printInvoice(Order $order)
    {
        if (! $this->user->can('order read')) {
            return redirect()->route('admin.unauthorized');
        }

        return view('admin.pages.orders.invoice-print', [
            'order' => $order,
        ]);
    }

    public function updateStatus(Request $request, Order $order): RedirectResponse
    {
        if (! $this->user->can('order delivery status update')) {
            return redirect()->route('admin.unauthorized');
        }

        $order->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Order status updated successfully');
    }

    public function updatePrice(Request $request, Order $order)
    {
        $request->validate([
            'discount_price' => 'required|numeric',
        ]);

        $discountPrice = $request->discount_price * 100;

        if ($discountPrice > $order->total_price) {
            return back()->with('error', 'Discount amount can not be larger than order total');
        }

        $totalPrice = $order->total_price + $discountPrice;

        try {
            $order->update([
                'discount_amount' => $discountPrice,
            ]);

            return redirect()->back()->with('success', 'Order amount adjusted successfully');

        } catch (Exception $e) {
            Log::info('OrderID: '.$order->id.' discount price could not update due to: '.$e->getMessage());

            return back()->with('error', 'Something went wrong');
        }
    }
}
