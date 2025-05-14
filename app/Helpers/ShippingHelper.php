<?php

namespace App\Helpers;

class ShippingHelper
{
    public static function getShippingFee(string $shippingMethod): float
    {
        $shippingMethods = config('delivery');

        return $shippingMethods[$shippingMethod]['fee'];
    }

    public static function getShippingLabel(string $shippingMethod): string
    {
        $shippingMethods = config('delivery');

        return $shippingMethods[$shippingMethod]['label'];
    }

    public static function getShippingLocation(string $shippingMethod): string
    {
        $shippingMethods = config('delivery');

        return $shippingMethods[$shippingMethod]['location'];
    }

    public static function getShippingDescription(string $shippingMethod): string
    {
        $shippingMethods = config('delivery');

        return $shippingMethods[$shippingMethod]['description'];
    }
}
