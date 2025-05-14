<?php

namespace App\Http\Livewire;

use App\Models\Wishlist;
use Livewire\Component;

class AddToWishlist extends Component
{
    public $product;

    public function mount($product)
    {
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.add-to-wishlist');
    }

    public function addToWishlist(): void
    {
        if (! auth()->check()) {
            $this->dispatchBrowserEvent('alert',
                [
                    'type' => 'warning',
                    'message' => 'Please login to add product to your wishlist! Click here to
                    <a href="'.route('frontend.auth.login').'"><strong>Login</strong></a>',
                ]);

            return;
        }

        $exist = Wishlist::where('customer_id', auth()->id())
            ->where('product_id', $this->product->id)
            ->first();
        if ($exist) {
            $this->dispatchBrowserEvent('alert',
                ['type' => 'warning', 'message' => 'Product has already in your wishlist!']);

        } else {
            $originalPrice = $this->product->value->promo_price ?: $this->product->value->sale_price;
            Wishlist::create([
                'customer_id' => auth()->id(),
                'product_id' => $this->product->id,
                'original_price' => $originalPrice,
                'ip_address' => request()->ip(),
            ]);

            $this->emit('wishlistUpdated', $this->product->id);

            $this->dispatchBrowserEvent('alert',
                ['type' => 'success', 'message' => 'Product added to your wishlist!']);

            if ($this->product->value->stock == 0) {
                $this->dispatchBrowserEvent('alert',
                    ['type' => 'warning', 'message' => 'Product is out of stock! We will let you know when it is available again.']);
            }
        }
    }
}
