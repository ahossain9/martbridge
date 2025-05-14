<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\CartHelper;
use App\Http\Controllers\Controller;
use App\Jobs\OrderPlacedMailJob;
use App\Models\Product;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function checkout()
    {
        // get the cart items from the session
        $cartItems = CartHelper::getCartItems();
        if (! $cartItems) {
            return redirect()->route('frontend.products.cart')
                ->with('error', 'Your cart is empty!');
        }
        foreach ($cartItems as $productId => $item) {
            $productAttributes = Product::find($item['product_id'])->attributes()->with('values')->get() ?? [];
            if (count($item['attributes']) != count($productAttributes)) {
                return redirect()->route('frontend.products.cart')
                    ->with('error', 'Please select all the product attributes!');
            } else {
                foreach ($productAttributes as $attribute) {
                    if (! isset($item['attributes'][$attribute->id]) || $item['attributes'][$attribute->id] == 0) {
                        return redirect()->route('frontend.products.cart')
                            ->with('error', 'Please select all the product attributes!');
                    }
                }
            }
        }

        // calculate the total price
        $totalPrice = 0;
        if ($cartItems) {
            foreach ($cartItems as $cartItem) {
                $totalPrice += $cartItem['price'] * $cartItem['quantity'];
            }
        }

        return view('frontend.pages.shop.checkout', [
            'cartItems' => $cartItems ?? [],
            'totalPrice' => $totalPrice,
        ]);
    }

    public function postCheckout(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'zip_code' => 'required',
            'country' => 'required',
            'delivery_method' => 'required',
        ]);

        // create an address from the request
        $address = auth()->user()->addresses()->create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'city' => $data['city'],
            'zip_code' => $data['zip_code'],
            'country' => $data['country'],
        ]);

        // calculate the total price
        $totalPrice = 0;
        $cartItems = CartHelper::getCartItems();

        foreach ($cartItems as $cartItem) {
            $totalPrice += $cartItem['price'] * $cartItem['quantity'];
        }

        // create an order from the request
        $order = auth()->user()->orders()->create([
            'status' => 'pending',
            'delivery_method' => $data['delivery_method'],
            'total_price' => $totalPrice * 100,
            'order_number' => rand(100000, 999999).auth()->id(),

        ]);

        // add items to the orderItems
        foreach ($cartItems as $key => $cartItem) {
            $order->orderItems()->create([
                'product_id' => $cartItem['product_id'],
                'quantity' => $cartItem['quantity'],
                'unit_price' => $cartItem['price'] * 100,
                'attributes' => $cartItem['attributes'] ?? [],
                'variants' => $cartItem['variants'] ?? [],
            ]);

            // update the product stock
            $product = Product::find($cartItem['product_id']);
            $product->value->stock -= $cartItem['quantity'];
            $product->value->save();
        }

        $order->orderDetails()->create([
            'customer_address_id' => $address->id,
            'order_note' => $request->order_note,
        ]);

        // OrderPlacedMailJob::dispatch($order);

        CartHelper::removeCartItems();

        toastr()->success('Order placed successfully, your product will be delivered soon!');

        return redirect()->route('frontend.shop.index');
    }
}
