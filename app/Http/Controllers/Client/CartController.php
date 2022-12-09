<?php

namespace App\Http\Controllers\Client;

use App\Enum\TimeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Cart\AddItemRequest;
use App\Http\Requests\Client\Cart\CheckoutRequest;
use App\Http\Requests\Client\Cart\RemoveItemRequest;
use App\Models\Cart;
use App\Models\PaymentMethod;
use App\Services\OrderService;
use Illuminate\Support\Facades\Cache;

class CartController extends Controller
{
    public function getCart() {
        $paymentMethods = Cache::remember(
            "payment-methods",
            TimeEnum::twenty_hrs,
            function() {
                return PaymentMethod::all();
            }
        );
        $cart = auth()->user()->cart?->load('items.product');
        if (!$cart) {
            return redirect(route('client.home'))
                ->with('warn-message', __('messages.empty-cart'));
        }
        return view('client.cart.index', ['cart' => $cart, 'paymentMethods' => $paymentMethods]);
    }

    public function addItem(AddItemRequest $request) {
        $cart = auth()->user()->cart;
        if (!$cart) $cart = Cart::create(['user_id' => auth()->user()->id]);

        // quantity fixed for now, till implement increment & decrement behavior
        $cart->items()->create(['product_id' => $request->product_id, 'quantity' => 1]);
        return redirect(route('client.cart.get'))
            ->with('success-message', __('messages.product-added'));
    }

    public function removeItem(RemoveItemRequest $request) {
        auth()->user()->cart->items()->where('product_id', $request->product_id)->delete();
        return redirect()->back()->with('success-message', __('messages.product-removed'));
    }

    public function checkout(CheckoutRequest $request) {
        OrderService::placeOrder(auth()->user()->load('cart.items.product'), $request);
        return redirect(route("client.home"))
            ->with('success-message', __('messages.order-placed'));
    }
}
