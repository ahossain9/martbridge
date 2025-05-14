<?php

namespace App\Helpers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartHelper
{
    public static function getCartItemsCount(): int
    {
        $request = request();
        $user = $request->user();
        if ($user) {
            return Cart::where('customer_id', $user->id)->sum('quantity');
        } else {
            $cartItems = self::getCookieCartItems();

            return array_reduce(
                $cartItems,
                fn ($carry, $item) => $carry + $item['quantity'],
                0
            );
        }
    }

    /*public static function getCartItems()
    {
        $request = \request();
        $user = $request->user();
        if ($user) {
            return Cart::where('customer_id', $user->id)->get()->map(
                fn($item) => ['product_id' => $item->product_id, 'quantity' => $item->quantity]
            );
        } else {
            return self::getCookieCartItems();
        }
    }*/

    public static function getCookieCartItems()
    {
        $request = request();

        return json_decode($request->cookie('cart_items', '[]'), true);
    }

    public static function getCountFromItems($cartItems)
    {
        return array_reduce(
            $cartItems,
            fn ($carry, $item) => $carry + $item['quantity'],
            0
        );
    }

    public static function moveItemFromSessionToDB(): void
    {
        if (auth()->check()) {
            $cartItems = session()->get('cart', []);

            if (! empty($cartItems)) {
                foreach ($cartItems as $key => $cartItem) {
                    $existingCartItem = Cart::where('customer_id', auth()->user()->id)
                        ->where('product_id', $cartItem['product_id'])
                        ->whereJsonContains('attributes', $cartItem['attributes'])
                        ->whereJsonContains('variants', $cartItem['variants'])
                        ->first();

                    if ($existingCartItem) {
                        $existingCartItem->quantity += $cartItem['quantity'];
                        $existingCartItem->save();
                    } else {
                        // Item doesn't exist in the database, insert it
                        Cart::create([
                            'customer_id' => auth()->user()->id,
                            'product_id' => $cartItem['product_id'],
                            'quantity' => $cartItem['quantity'],
                            'price' => $cartItem['price'],
                            'attributes' => $cartItem['attributes'] ?? [],
                            'variants' => $cartItem['variants'] ?? [],
                        ]);
                    }
                }
            }

            // Clear the session cart after transferring items to the database
            session()->forget('cart');
        }
    }

    public static function getCartItems()
    {
        if (auth()->check()) {
            $cartItems = Cart::where(['customer_id' => auth()->user()->id])->get();
            $cartItems = $cartItems->map(
                fn ($item) => [
                    'id' => $item->id,
                    'product_id' => $item->product_id,
                    'session_key' => $item->session_key,
                    'name' => $item->product->name,
                    'slug' => $item->product->slug,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'photo' => $item->product->featured_image,
                    'attributes' => $item->attributes ?? [],
                    'variants' => $item->variants ?? [],
                ]
            )->toArray();
        } else {
            $cartItems = session()->get('cart');
        }

        return $cartItems;
    }

    public static function removeCartItem($cartItemId): void
    {
        if (auth()->check()) {
            $cartItem = Cart::find($cartItemId);

            if ($cartItem) {
                $cartItem->delete();
            }
        } else {
            // If user is a guest, remove the cart item from the session
            $cartItems = session()->get('cart', []);

            if (array_key_exists($cartItemId, $cartItems)) {
                unset($cartItems[$cartItemId]);
                session()->put('cart', $cartItems);
            }
        }
    }

    public static function addToCart($product_id, $qty = 1, $selectedAttributes = [], $selectedVariants = [], $variantPrice = 0): void
    {
        $attributeArray = [];
        foreach ($selectedAttributes as $key => $selectedAttribute) {
            if (is_array($selectedAttribute)) {
                $attributeArray[$key] = array_key_first($selectedAttribute);
            } else {
                $attributeArray[$key] = (int) $selectedAttribute;
            }
        }

        $product = Product::find($product_id);

        $updatedPrice = $product->value->promo_price > 0 ? $product->value->promo_price : $product->value->sale_price;
        if ($variantPrice > 0) {
            $updatedPrice = $variantPrice;
        }

        if (auth()->check()) {
            $existingCartItem = Cart::where('customer_id', auth()->user()->id)
                ->where('product_id', $product_id)
                ->whereJsonContains('attributes', $attributeArray)
                ->whereJsonContains('variants', $selectedVariants)
                ->first();

            if ($existingCartItem) {
                // Check if the variants are exactly the same
                if ($existingCartItem->variants == $selectedVariants) {
                    $existingCartItem->quantity += $qty;
                    $existingCartItem->save();
                } else {
                    // If variants are different, create a new cart item
                    Cart::create([
                        'customer_id' => auth()->user()->id,
                        'product_id' => $product_id,
                        'quantity' => $qty,
                        'price' => $updatedPrice,
                        'attributes' => $attributeArray,
                        'variants' => $selectedVariants,
                    ]);
                }
            } else {
                Cart::create([
                    'customer_id' => auth()->user()->id,
                    'product_id' => $product_id,
                    'quantity' => $qty,
                    'price' => $updatedPrice,
                    'attributes' => $attributeArray,
                    'variants' => $selectedVariants,
                ]);
            }
        } else {
            $cartItems = session()->get('cart', []);
            $cartKey = $product_id.'_'.implode('_', $attributeArray).'_'.implode('_', $selectedVariants);

            if (array_key_exists($cartKey, $cartItems)) {
                $cartItems[$cartKey]['quantity'] += $qty;
            } else {
                $cartItems[$cartKey] = [
                    'session_key' => session()->getId(),
                    'product_id' => $product_id,
                    'quantity' => $qty,
                    'price' => $updatedPrice,
                    'attributes' => $attributeArray,
                    'variants' => $selectedVariants,
                ];
            }
            session()->put('cart', $cartItems);
        }
    }

    public static function updateProductQuantity($product_id, $quantity, $selectedAttributes = [], $selectedVariants = []): void
    {
        $attributeArray = [];
        foreach ($selectedAttributes as $key => $selectedAttribute) {
            if (is_array($selectedAttribute)) {
                $attributeArray[$key] = array_key_first($selectedAttribute);
            } else {
                $attributeArray[$key] = (int) $selectedAttribute;
            }
        }

        if (auth()->check()) {
            $existingCartItem = Cart::where('customer_id', auth()->user()->id)
                ->where('product_id', $product_id)
                ->whereJsonContains('attributes', $attributeArray)
                ->whereJsonContains('variants', $selectedVariants)
                ->first();

            if ($existingCartItem) {
                // Update the quantity if the product with the same attributes and variants is found
                $existingCartItem->quantity = $quantity;
                $existingCartItem->save();
            }
        } else {
            $cartItems = session()->get('cart', []);
            $cartKey = $product_id.'_'.implode('_', $attributeArray).'_'.implode('_', $selectedVariants);

            if (array_key_exists($cartKey, $cartItems)) {
                // Update the quantity if the product with the same attributes and variants is found
                $cartItems[$cartKey]['quantity'] = $quantity;
                session()->put('cart', $cartItems);
            }
        }
    }

    public static function removeCartItems()
    {
        session()->forget('cart');
        if (auth()->check()) {
            Cart::where(['customer_id' => auth()->user()->id])->delete();
        }
    }

    public static function updateProductAttributes($productId, $selectedAttributes): void
    {
        if (auth()->check()) {
            Cart::where(['customer_id' => auth()->user()->id, 'product_id' => $productId])->update(['attributes' => $selectedAttributes]);
        } else {
            $cartItems = session()->get('cart');
            $cartItems[$productId]['attributes'] = $selectedAttributes;
            session()->put('cart', $cartItems);
        }

    }
}
