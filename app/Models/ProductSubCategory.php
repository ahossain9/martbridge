<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductSubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'product_category_id',
        'slug',
        'is_active',
        'image',
        'is_shown_to_home_page',
        'created_by',
    ];

    public function product_category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function productAttributes(): HasMany
    {
        return $this->hasMany(Attribute::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
