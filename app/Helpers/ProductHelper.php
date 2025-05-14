<?php

namespace App\Helpers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductSubCategory;
use App\Models\Slider;

class ProductHelper
{
    public static function getProductsBySubCategoryDesc($sub_category_id)
    {
        $products = Product::where('product_sub_category_id', $sub_category_id)
            ->where('is_active', true)
            ->orderBy('id', 'desc')
            ->limit(16)
            ->get();

        return $products ?? [];
    }

    public static function getProductsByBrandDesc($brandID)
    {
        $products = Product::where('brand_id', $brandID)
            ->where('is_active', true)
            ->orderBy('id', 'desc')
            ->limit(16)
            ->get();

        return $products ?? [];
    }

    public static function subCategoriesWithCount()
    {
        return ProductSubCategory::withCount(['products' => function ($query) {
            $query->where('is_active', true);
        }])->get() ?? [];
    }

    public static function brandsWithCount()
    {
        return Brand::withCount(['products' => function ($query) {
            $query->where('is_active', true);
        }])->where('is_active', true)->get() ?? [];
    }

    public static function getBrands()
    {
        return Brand::where('is_active', true)->get() ?? [];
    }

    public static function getBrandsWithImage()
    {
        return Brand::where('is_active', true)->where('logo', '!=', null)->get() ?? [];
    }

    public static function getSubcategoryByAlphabet()
    {
        return ProductSubCategory::where('is_active', true)->orderBy('name')->get() ?? [];
    }

    public static function getFeaturedProducts()
    {
        return Product::where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('id', 'desc')
            ->get();
    }

    public static function getTopProducts()
    {
        return Product::where('is_active', true)
            ->whereJsonContains('labels', ['name' => 'top'])
            ->orWhereJsonContains('labels', ['name' => 'Top'])
            ->orderBy('id', 'desc')
            ->get();
    }

    public static function getOnSaleProducts()
    {
        return Product::query()->where('is_active', true)
            ->whereJsonContains('labels', ['name' => 'sale'])
            ->orWhereJsonContains('labels', ['name' => 'Sale'])
            ->orderBy('id', 'desc')
            ->get();
    }

    public static function getTrendingTopBanner()
    {
        return Slider::query()
            ->where('status', true)
            ->where('slider_type', 'trending')
            ->latest()
            ->first();
    }

    public static function countProductByCondition(string $condition): int
    {
        return Product::query()->where('condition', $condition)->count() ?? 0;
    }
}
