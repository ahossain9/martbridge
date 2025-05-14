<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\View\View;
use Livewire\Component;

class ProductSearch extends Component
{
    public string $search = '';

    public $categories = [];

    public $searchResults = [];

    public function mount(): void
    {
        $this->categories = ProductCategory::with('productSubCategories')
            ->orderBy('name')
            ->get();
    }

    public function render(): View
    {
        return view('livewire.product-search');
    }

    public function getSearchResult(): void
    {
        if (! empty($this->search)) {
            $this->searchResults = Product::where('is_active', true)
                ->where('name', 'like', '%'.$this->search.'%')
                ->orWhere('description', 'like', '%'.$this->search.'%')
                ->orWhere('short_description', 'like', '%'.$this->search.'%')
                ->orWhere('slug', 'like', '%'.$this->search.'%')
                ->orWhere('category_name', 'like', '%'.$this->search.'%')
                ->orWhere('sub_category_name', 'like', '%'.$this->search.'%')
                ->get();
        }
    }
}
