<?php

namespace App\Http\Livewire;

use App\Helpers\CartHelper;
use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;

class ShopByBrand extends Component
{
    public function render()
    {
        $brands = Brand::where('is_active', true)->with('products')
            ->whereHas('products', function ($query) {
                $query->where('is_active', true);
            })
            ->get();

        return view('livewire.shop-by-brand', [
            'brands' => $brands,
        ]);
    }

    public function addItemToCart($productId): void
    {
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
}
