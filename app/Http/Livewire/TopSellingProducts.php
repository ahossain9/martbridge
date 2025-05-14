<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\ProductSubCategory;
use Livewire\Component;

class TopSellingProducts extends Component
{
    public function render()
    {
        $topSaleProducts = Product::query()
            ->where('is_active', true)
            ->where('is_top_sale', true)
            ->orderBy('created_at', 'desc')
            ->take(8)->get();

        $topSaleSubCategories = ProductSubCategory::whereHas('products', function ($query) {
            $query->where('is_top_sale', true);
        })->with('products')->get();

        return view('livewire.top-selling-products', [
            'topSaleProducts' => $topSaleProducts,
            'topSaleSubCategories' => $topSaleSubCategories,
        ]);
    }
}
