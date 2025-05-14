<?php

namespace App\Http\Livewire;

use App\Models\Wishlist;
use Illuminate\View\View;
use Livewire\Component;

class ProductWishlist extends Component
{
    protected $listeners = ['wishlistUpdated' => '$refresh'];

    public function render(): View
    {
        $wishlistProducts = Wishlist::with(['customer', 'product'])
            ->where('customer_id', auth()->id())
            ->get();

        return view('livewire.product-wishlist', [
            'wishlistProducts' => $wishlistProducts,
        ]);
    }

    public function removeFromWishList($productId): void
    {
        try {
            Wishlist::where('customer_id', auth()->id())
                ->where('product_id', $productId)
                ->delete();

            $this->emit('wishlistUpdated');

            $this->dispatchBrowserEvent('alert',
                ['type' => 'info', 'message' => 'Product removed from your wishlist!']);

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert',
                ['type' => 'error', 'message' => 'Something went wrong!']);
        }
    }
}
