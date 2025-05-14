<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\SearchProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class ShopController extends Controller
{
    public function index()
    {
        return view('frontend.pages.shop.index');
    }

    public function product($slug)
    {
        $product = Cache::rememberForever('product_'.$slug, function () use ($slug) {
            return Product::with('value', 'galleries.images')
                ->where('slug', $slug)
                ->where('is_active', true)
                ->firstOrFail();
        });

        // retrieve related products
        $relatedProducts = Cache::rememberForever('related_products_'.$slug, function () use ($product) {
            return Product::with('value', 'galleries.images')
                ->where('is_active', true)
                ->where('category_name', $product->category_name)
                ->where('id', '!=', $product->id)
                ->orderBy('created_at', 'desc')
                ->take(6)->get();
        });

        // random products
        $randomProducts = Cache::rememberForever('random_products_'.$slug, function () use ($product) {
            return Product::with('value', 'galleries.images')
                ->where('is_active', true)
                ->inRandomOrder()
                ->where('id', '!=', $product->id)
                ->orderBy('created_at', 'desc')
                ->take(10)->get();
        });

        return view('frontend.pages.shop.product', [
            'product' => $product ?? [],
            'relatedProducts' => $relatedProducts ?? [],
            'randomProducts' => $randomProducts ?? [],
        ]);
    }

    public function cart()
    {
        return view('frontend.pages.shop.cart');
    }

    public function search(Request $request): JsonResponse
    {
        $queryString = $request->input('query');

        $products = Product::with('value', 'galleries.images')
            ->where(function ($query) use ($queryString) {
                $query->where('is_active', true)
                    ->where(function ($subquery) use ($queryString) {
                        $subquery->where('name', 'like', '%'.$queryString.'%')
                            ->orWhere('description', 'like', '%'.$queryString.'%')
                            ->orWhere('short_description', 'like', '%'.$queryString.'%')
                            ->orWhere('slug', 'like', '%'.$queryString.'%')
                            ->orWhere('category_name', 'like', '%'.$queryString.'%')
                            ->orWhere('sub_category_name', 'like', '%'.$queryString.'%');
                    });
            })
            ->take(10)
            ->get();

        return response()->json(SearchProductResource::collection($products));
    }

    public function wishlist(): View
    {
        return view('frontend.pages.shop.wishlist');
    }
}
