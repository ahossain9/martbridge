<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariationDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_variation_id',
        'description',
    ];
}
