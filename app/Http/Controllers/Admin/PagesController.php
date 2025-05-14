<?php

namespace App\Http\Controllers\Admin;

use App\Constants\AdminConstant;
use App\Http\Controllers\Admin\API\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PagesController extends BaseController
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
        if (! $this->user->can('dashboard view')) {
            return redirect()->route('admin.unauthorized');
        }

        $totalSale = Order::query()->sum('total_price');
        $totalOrder = Order::query()->count();
        $totalPendingOrder = Order::query()->where('status', 'pending')->count();
        $totalDeliveredOrder = Order::query()->where('status', 'delivered')->count();
        $totalCancelledOrder = Order::query()->where('status', 'cancelled')->count();
        $totalRefundedOrder = Order::query()->where('status', 'refunded')->count();
        $totalRevenue = Order::query()->where('status', 'delivered')->sum('total_price');

        $totalCustomer = Order::query()->distinct('customer_id')->count('customer_id');
        $totalProducts = Product::query()->distinct('id')->count('id');

        $totalEarningsOfThisMonth = Order::query()
            ->where('status', 'delivered')
            ->whereMonth('created_at', now()->month)
            ->sum('total_price');

        // get the percentage of total earnings of this month compared to the last month
        $lastMonthEarnings = Order::query()
            ->where('status', 'delivered')
            ->whereMonth('created_at', now()->subMonth()->month)
            ->sum('total_price');

        $vendors = Vendor::query()->get();

        $earningPercentage = 0;
        if ($lastMonthEarnings > 0) {
            $earningPercentage = ($totalEarningsOfThisMonth - $lastMonthEarnings) / $lastMonthEarnings * 100;
            $earningPercentage = number_format($earningPercentage, 2, '.', ',');
        }

        return view('admin.pages.home.index', [
            'totalSale' => $totalSale,
            'totalOrder' => $totalOrder,
            'totalPendingOrder' => $totalPendingOrder,
            'totalDeliveredOrder' => $totalDeliveredOrder,
            'totalCancelledOrder' => $totalCancelledOrder,
            'totalRefundedOrder' => $totalRefundedOrder,
            'totalCustomer' => $totalCustomer,
            'totalProducts' => $totalProducts,
            'totalRevenue' => $totalRevenue,
            'totalEarningsOfThisMonth' => $totalEarningsOfThisMonth,
            'earningPercentage' => $earningPercentage,
            'vendors' => $vendors,
        ]);
    }

    public function unauthorized()
    {
        return view('admin.auth.pages.unauthorized');
    }

    public function topSellingItems(): JsonResponse
    {
        $query = "
            SELECT
            p.id AS product_id,
            p.name AS product_name,
            SUM(oi.quantity) AS total_quantity_sold
            FROM
                order_items oi
            JOIN
                products p ON oi.product_id = p.id
            GROUP BY
                p.id, p.name
            ORDER BY
                total_quantity_sold DESC
            LIMIT 10;
        ";

        $topSellingProducts = DB::select($query);

        $responseData =  [
            'labels' => array_column($topSellingProducts, 'product_name'),
            'data' => array_column($topSellingProducts, 'total_quantity_sold'),
        ];

        return $this->sendResponse($responseData, 'Top selling items retrieved successfully.');
    }
}
