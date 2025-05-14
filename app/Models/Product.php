<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Cache;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'product_category_id',
        'category_name',
        'product_sub_category_id',
        'sub_category_name',
        'brand_id',
        'brand_name',
        'vendor_id',
        'label',
        'labels',
        'featured_image',
        'video_link',
        'condition',
        'short_description',
        'is_featured',
        'is_trending',
        'is_top_sale',
        'advance_amount',
        'variant_options',
        'variant_combinations',
        'is_active',
        'added_by',
        'updated_by',
    ];

    protected static function boot()
    {
        parent::boot();

        static::updating(function ($product) {
            Cache::forget('product_'.$product->slug);
            Cache::forget('related_products_'.$product->slug);
            Cache::forget('random_products_'.$product->slug);
        });

        static::deleting(function ($product) {
            Cache::forget('product_'.$product->slug);
            Cache::forget('related_products_'.$product->slug);
            Cache::forget('random_products_'.$product->slug);
        });
    }

    protected $casts = [
        'labels' => 'array',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class);
    }

    public function sub_category(): BelongsTo
    {
        return $this->belongsTo(ProductSubCategory::class);
    }

    public function variations(): HasMany
    {
        return $this->hasMany(ProductVariation::class);
    }

    public function variantCombinations(): HasMany
    {
        return $this->hasMany(ProductVariantCombination::class);
    }

    public function value(): HasOne
    {
        return $this->hasOne(ProductValue::class);
    }

    public function attributes(): HasMany
    {
        return $this->hasMany(ProductAttribute::class);
    }

    public function galleries(): HasMany
    {
        return $this->hasMany(ProductImageGallery::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(ProductReview::class);
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
