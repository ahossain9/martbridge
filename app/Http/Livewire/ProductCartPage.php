<?php

namespace App\Http\Livewire;

use App\Helpers\CartHelper;
use App\Models\Product;
use Illuminate\View\View;
use Livewire\Component;

class ProductCartPage extends Component
{
    protected $listeners = ['cartUpdated' => '$refresh'];

    public array $selectedAttributes = [];

    public array $itemQuantity = [];

    public array $cartItems = [];

    public function mount(): void
    {
        $this->cartItems = CartHelper::getCartItems() ?? [];

        foreach ($this->cartItems as $productId => $item) {
            $this->itemQuantity[$productId] = $item['quantity'];
            $this->selectedAttributes[$productId] = $item['attributes'];
        }

    }

    public function render(): View
    {
        $this->cartItems = CartHelper::getCartItems() ?? [];

        $totalPrice = 0;
        foreach ($this->cartItems as $item) {
            $totalPrice += $item['quantity'] * $item['price'];
        }

        return view('livewire.product-cart-page', [
            'cartItems' => $this->cartItems,
            'totalPrice' => $totalPrice,
        ]);
    }

    public function removeItemFromCartPage($productId): void
    {
        CartHelper::removeCartItem($productId);

        $this->emit('cartRemoved');

        $this->dispatchBrowserEvent('alert',
            ['type' => 'info', 'message' => 'Product removed successfully!']);
    }

    public function updateItemQuantity($key, $productId, $attributes = [], $variants = []): void
    {
        CartHelper::updateProductQuantity($productId, $this->itemQuantity[$key],
            json_decode($attributes, true),
            json_decode($variants, true));

        $this->dispatchBrowserEvent('alert',
            ['type' => 'info', 'message' => 'Product quantity updated successfully!']);

        $this->emit('cartUpdated');
    }

    public function updateProductAttributes($productId, $attributeId, $valueId): void
    {
        $this->selectedAttributes[$productId][$attributeId] = (int) $valueId;

        CartHelper::updateProductAttributes($productId, $this->selectedAttributes[$productId]);

        $this->emit('cartUpdated');

        $this->dispatchBrowserEvent('alert',
            ['type' => 'info', 'message' => 'Product has updated successfully!']);

    }

    public function checkAttributes()
    {
        $this->cartItems = CartHelper::getCartItems() ?? [];

        foreach ($this->cartItems as $productId => $item) {
            $attributes = Product::find($item['product_id'])->attributes()->with('values')->get();

            if (count($attributes) > 0 && $item['attributes'] == null) {
                $this->dispatchBrowserEvent('alert',
                    ['type' => 'warning', 'message' => 'Please select attributes for '.$item['name']]);

                return;
            } else {
                foreach ($attributes as $attribute) {
                    if (! isset($item['attributes'][$attribute->id])) {
                        $this->dispatchBrowserEvent('alert',
                            ['type' => 'warning', 'message' => 'Please select '.$attribute->name.' for '.$item['name']]);

                        return;
                    } elseif ($item['attributes'][$attribute->id] == 0) {
                        $this->dispatchBrowserEvent('alert',
                            ['type' => 'warning', 'message' => 'Please select '.$attribute->name.' for '.$item['name']]);

                        return;
                    }
                }
            }
        }

        return redirect()->route('frontend.products.checkout');
    }
}
