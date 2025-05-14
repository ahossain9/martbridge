<?php

namespace App\Http\Livewire;

use App\Helpers\CartHelper;
use App\Models\Product;
use Livewire\Component;

class RandomProducts extends Component
{
    public function render()
    {
        $products = Product::query()
            ->where('is_active', true)
            ->inRandomOrder()->take(24)->get();

        return view('livewire.random-products', [
            'randomProducts' => $products,
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
