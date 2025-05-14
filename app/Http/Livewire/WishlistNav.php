<?php

namespace App\Http\Livewire;

use Livewire\Component;

class WishlistNav extends Component
{
    protected $listeners = ['wishlistUpdated' => '$refresh', 'wishlistRemoved' => '$refresh'];

    public function render()
    {
        if (! auth()->check()) {
            $wishlistProductCount = 0;
        } else {
            $wishlistProductCount = auth()->user()->wishlist()->count() ?? 0;
        }

        return view('livewire.wishlist-nav', [
            'wishlistProductCount' => $wishlistProductCount,
        ]);
    }
}
