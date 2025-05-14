<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariantCombination extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'name',
        'price',
        'stock_quantity',
        'sku',
        'discount',
        'discount_type',
        'weight',
        'length',
        'width',
        'height',
        'is_active',
    ];
}
