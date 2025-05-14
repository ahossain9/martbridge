<?php

namespace App\Http\Livewire;

use App\Helpers\CartHelper;
use App\Models\Product;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class ProductsShop extends Component
{
    use WithPagination;

    const PER_PAGE = 24;

    protected string $paginationTheme = 'bootstrap';

    public array $selectedCategories = [];

    public array $brands = [];

    public array $conditions = [];

    protected $listeners = ['cartRemoved' => 'removeFromCart'];

    public function render(): View
    {

        if (request()->has('category')) {
            $this->selectedCategories = explode(',', request()->get('category'));
        }

        if (request()->has('brand')) {
            $this->brands = explode(',', request()->get('brand'));
        }

        if (request()->has('search-query')) {
            $searchQuery = request()->get('search-query');
            $products = Product::where('is_active', true)
                ->where('name', 'like', '%'.$searchQuery.'%')
                ->orWhere('description', 'like', '%'.$searchQuery.'%')
                ->orWhere('short_description', 'like', '%'.$searchQuery.'%')
                ->orWhere('slug', 'like', '%'.$searchQuery.'%')
                ->orWhere('category_name', 'like', '%'.$searchQuery.'%')
                ->orWhere('sub_category_name', 'like', '%'.$searchQuery.'%')
                ->orderBy('id', 'desc')
                ->paginate(self::PER_PAGE);
        } else {
            $products = Product::query()
                ->where('is_active', 1)
                ->when($this->selectedCategories, function ($query) {
                    $query->whereIn('sub_category_name', $this->selectedCategories);
                })
                ->when($this->brands, function ($query) {
                    $query->whereIn('brand_name', $this->brands);
                })
                ->when($this->conditions, function ($query) {
                    $query->whereIn('condition', $this->conditions);
                })
                ->with('value', 'galleries.images')
                ->orderBy('id', 'desc')
                ->paginate(self::PER_PAGE);
        }

        return view('livewire.products-shop', [
            'products' => $products,
        ]);
    }

    public function addToCart($productId): void
    {
        $product = Product::query()->where('id', $productId)->first();

        if (! $product) {
            $this->dispatchBrowserEvent('alert',
                ['type' => 'warning', 'message' => 'Product not found!']);

            return;
        }

        if ($product->value->stock <= 0) {
            $this->dispatchBrowserEvent('alert',
                ['type' => 'warning', 'message' => 'Product is out of stock!']);

            return;
        }

        CartHelper::addToCart($productId);
        $this->emit('cartUpdated');

        $this->dispatchBrowserEvent('alert',
            ['type' => 'info', 'message' => 'Item added to cart successfully!']);
    }

    public function removeFromCart($productId): void
    {
        CartHelper::removeCartItem($productId);
        $this->emit('cartUpdated');

        //        session()->flash('message', 'Product removed successfully!');
        $this->dispatchBrowserEvent('alert',
            ['type' => 'info', 'message' => 'Product removed successfully!']);

    }

    public function updateQuantity($productId): void
    {
        CartHelper::updateProductQuantity($productId);

        $this->emit('cartUpdated');
        //        session()->flash('message', 'Product quantity updated successfully!');

        $this->dispatchBrowserEvent('alert',
            ['type' => 'info', 'message' => 'uantity updated successfully!']);
    }
}
