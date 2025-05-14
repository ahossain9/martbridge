<?php

namespace App\Helpers;

class CurrencyHelper
{
    public static function format(float $amount): string
    {
        return number_format($amount, 0, '.', ',');
    }

    public static function formatWithCurrency(float $amount): string
    {
        return self::format($amount).' BDT';
    }

    public static function formatWithCurrencyAndSign(float $amount): string
    {
        return '৳ '.self::format($amount);
    }
}
