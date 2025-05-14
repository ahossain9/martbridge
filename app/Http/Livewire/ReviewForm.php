<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ReviewForm extends Component
{
    public $product;

    public $rating = 1;

    public $title;

    public $description;

    protected $rules = [
        'rating' => 'required|integer|min:1|max:5',
        'title' => 'required|string|min:3|max:255',
        'description' => 'required|string|min:3|max:255',
    ];

    public function mount($product)
    {
        $this->product = $product;
    }

    public function render()
    {
        $reviews = $this->product->reviews()->latest()->get();

        return view('livewire.review-form', [
            'reviews' => $reviews,
        ]);
    }

    public function saveReview()
    {
        $this->validate();

        // check the user is logged in
        if (! auth()->check()) {
            session()->flash('error', 'You must be logged in to submit a review!');

            return redirect()->route('frontend.auth.login')->with('error', 'You must be logged in to submit a review!');
        }

        $slug = $this->product->slug;

        $this->product->reviews()->create([
            'customer_id' => Auth::id(),
            'rating' => $this->rating,
            'title' => $this->title,
            'description' => $this->description,
        ]);
        $this->dispatchBrowserEvent('alert',
            ['type' => 'success', 'message' => 'Review submitted successfully!']);
        $this->reset();

        return redirect()->route('frontend.shop.product', [$slug]);
    }
}
