<?php

namespace App\Helpers;

use App\Models\Order;

class OrderHelper
{
    public static function getOrderStatuses(): array
    {
        return [
            'pending' => 'Pending',
            'processing' => 'Processing',
            'delivered' => 'Delivered',
            'shipped' => 'Shipped',
            'cancelled' => 'Cancelled',
        ];
    }

    public static function getPendingOrdersCount()
    {
        return Order::where('status', '=', 'pending')->count();
    }
}
