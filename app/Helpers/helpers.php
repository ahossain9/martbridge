<?php

use App\Helpers\FileManageHelper;
use App\Models\Contact;

function formatPrice(int $price): string
{
    return number_format($price, 0, '.', ',');
}

function formatPercent(float $percent): string
{
    return number_format($percent, 2, ',', '.');
}

function formatPriceWithBdCurrency(int $price): string
{
    return '৳ '.formatPrice($price);
}

function getImageUrl(string $path): string
{
    if (! $path) {
        return '#';
    }

    return FileManageHelper::getS3FileUrl($path);
}

function countContactRequests(): int
{
    return Contact::where('is_read', false)->count() ?? 0;
}

// need to make the amount like 10K, 10M, 10B
function makeHumanize(int $value): string
{
    if ($value < 1000) {
        return $value;
    }

    if ($value < 1000000) {
        return round($value / 1000, 1).'K';
    }

    if ($value < 1000000000) {
        return round($value / 1000000, 1).'M';
    }

    return round($value / 1000000000, 1).'B';
}

function currency(): string
{
    return '৳';
}
