<?php

namespace App\Helpers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use Illuminate\Database\Eloquent\Collection;

class ShopHelper
{
    public static function categories(): Collection|array
    {
        return ProductCategory::with('productSubCategories')->get();
    }

    public static function subcategories()
    {
        return ProductSubCategory::orderBy('name', 'asc')->get();
    }

    public static function subcategoryProducts($subcategory_id)
    {
        return Product::where('product_sub_category_id', $subcategory_id)->get();
    }
}
