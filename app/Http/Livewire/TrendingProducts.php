<?php

namespace App\Http\Livewire;

use App\Helpers\CartHelper;
use App\Models\Product;
use App\Models\ProductSubCategory;
use App\Models\Slider;
use Livewire\Component;

class TrendingProducts extends Component
{
    public function render()
    {
        $tendingProductBanner = Slider::query()
            ->where('status', true)
            ->where('slider_type', 'trending')
            ->latest()
            ->first();

        $allProducts = Product::query()
            ->where('is_active', true)
            ->where('is_trending', true)
            ->orderBy('created_at', 'desc')
            ->take(8)->get();

        $trendingSubCategories = ProductSubCategory::whereHas('products', function ($query) {
            $query->where('is_trending', true);
        })->with('products')->get();

        return view('livewire.trending-products', [
            'tendingProductBanner' => $tendingProductBanner,
            'allProducts' => $allProducts,
            'trendingSubCategories' => $trendingSubCategories,
        ]);
    }

    public function addItemToCart($productId): void
    {
        dd($productId);
        $product = Product::query()
            ->where('is_active', true)
            ->where('id', $productId)->first();

        if (! $product) {
            $this->dispatchBrowserEvent('alert',
                ['type' => 'warning',  'message' => 'Product not found!']);

            return;
        }

        if ($product->value->stock <= 0) {
            $this->dispatchBrowserEvent('alert',
                ['type' => 'warning',  'message' => 'Product is out of stock!']);

            return;
        }

        CartHelper::addToCart($productId);

        $this->emit('cartUpdated');

        $this->dispatchBrowserEvent('alert',
            ['type' => 'info',  'message' => 'Item added to cart successfully!']);
    }

    public function clickTest()
    {
        dd('okay');
    }
}
