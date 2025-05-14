<?php

namespace App\Http\Livewire;

use App\Helpers\CartHelper;
use App\Models\Product;
use Illuminate\View\View;
use Livewire\Component;

class ProductPage extends Component
{
    public $product;

    public $selectedAttributes = [];

    public $productAttributes = [];

    public int $qty = 1;

    public $variantOptions = [];

    public $selectedValues = [];

    public $initialCombination;

    public $initialPrice;

    public function mount($product): void
    {
        $this->product = $product;

        foreach ($this->product->variations as $option) {
            if (! empty($option['values'])) {
                $firstValue = $option['values'][0]['value'];
                $this->selectedValues[$option['name']] = $firstValue;
            }
        }

        // Set the initial combination
        $this->initialCombination = $this->getCombinationString();

        // Fetch the initial price based on the combination from the database
        $this->initialPrice = $this->fetchPriceForCombination($this->initialCombination);
    }

    public function render(): View
    {
        $this->productAttributes = $this->product->attributes()->with('values')->get();

        return view('livewire.product-page', [
            'attributes' => $this->productAttributes,
        ]);
    }

    public function toggleValue($optionName, $selectedValue): void
    {
        // Check if a value is already selected for the given option
        if (isset($this->selectedValues[$optionName]) && $this->selectedValues[$optionName] === $selectedValue) {
            // If the same value is clicked again, unselect it
            unset($this->selectedValues[$optionName]);
        } else {
            // Select the clicked value for the option
            $this->selectedValues[$optionName] = $selectedValue;
        }

        $this->updateCombinationAndPrice();
    }

    protected function updateCombinationAndPrice(): void
    {
        // Update the current combination based on selected values
        $this->initialCombination = $this->getCombinationString();

        // Fetch the price based on the updated combination from the database
        $this->initialPrice = $this->fetchPriceForCombination($this->initialCombination);
    }

    public function isSelected($optionName, $value): bool
    {
        // Check if the value is selected for the given option
        return isset($this->selectedValues[$optionName]) && $this->selectedValues[$optionName] === $value;
    }

    protected function getCombinationString(): string
    {
        $valuesOnly = array_values($this->selectedValues);

        return implode('/', $valuesOnly);
    }

    protected function fetchPriceForCombination($combination)
    {
        $combination = $this->product->variantCombinations()->where('name', $combination)->first();

        if ($combination) {
            return $combination->price;
        }

        return $this->product->value->price;
    }

    public function updateSelectedAttributes($attributeId, $valueId, $newValue): void
    {
        $this->selectedAttributes[$attributeId] = [$valueId => $newValue];
    }

    public function addToCart($productId): void
    {
        $product = Product::where('is_active', true)
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

        if (count($this->productAttributes) > 0) {
            foreach ($this->productAttributes as $attribute) {
                if (! isset($this->selectedAttributes[$attribute->id])) {
                    $this->dispatchBrowserEvent('alert',
                        ['type' => 'warning',  'message' => 'Please select '.$attribute->name]);

                    return;
                }
            }
        }

        CartHelper::addToCart($productId, $this->qty, $this->selectedAttributes, $this->selectedValues, $this->initialPrice);

        $this->emit('cartUpdated');

        $this->dispatchBrowserEvent('alert',
            ['type' => 'info',  'message' => 'Product added to cart successfully!']);
    }
}
