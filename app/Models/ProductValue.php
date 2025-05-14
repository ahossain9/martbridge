<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'combination_string',
        'unique_string_id',
        'sku',
        'barcode',
        'base_price',
        'sale_price',
        'promo_price',
        'advance_amount',
        'allow_coupon',
        'stock',
        'moq',
    ];
}
