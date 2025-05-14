<?php

namespace App\Http\Livewire;

use App\Helpers\CartHelper;
use App\Models\Product;
use Livewire\Component;

class ShoppingCart extends Component
{
    protected $listeners = ['cartUpdated' => '$refresh', 'cartRemoved' => '$refresh'];

    public function render()
    {
        $cartItems = CartHelper::getCartItems() ?? [];

        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item['quantity'] * $item['price'];
        }

        return view('livewire.shopping-cart', [
            'cartItems' => $cartItems,
            'totalPrice' => $totalPrice,
        ]);
    }

    public function removeCartItem($productId): void
    {
        CartHelper::removeCartItem($productId);

        $this->emit('cartRemoved', $productId);

        $this->dispatchBrowserEvent('alert',
            ['type' => 'info',  'message' => 'Product removed successfully!']);

        // update the cart count
        $this->emit('cartUpdated');
    }

    public function processToCheckout()
    {
        $cartItems = CartHelper::getCartItems() ?? [];

        foreach ($cartItems as $productId => $item) {
            $productAttributes = Product::find($productId)->attributes ?? [];
            if (count($item['attributes']) != count($productAttributes)) {
                return redirect()->route('frontend.products.cart')
                    ->with('error', 'Please select all the product attributes!');
            }
        }

        return redirect()->route('frontend.products.checkout');
    }
}
