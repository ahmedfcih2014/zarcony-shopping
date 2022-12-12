<?php

namespace App\Http\Controllers\Client;

use App\Enum\TimeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Cart\AddItemRequest;
use App\Http\Requests\Client\Cart\CheckoutRequest;
use App\Http\Requests\Client\Cart\RemoveItemRequest;
use App\Models\Cart;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Cache;
use App\Services\Order\Invoker as OrderService;

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
        $cart = Cart::where('user_id', auth()->user()->id)->with('items.product')->first();
        if (!$cart) {
            return redirect(route('client.home'))
                ->with('warn-message', __('messages.empty-cart'));
        }
        return view('client.cart.index', ['cart' => $cart, 'paymentMethods' => $paymentMethods]);
    }

    public function addItem(AddItemRequest $request) {
        $cart = Cart::firstOrCreate(['user_id' => auth()->user()->id]);

        // quantity fixed for now, till implement increment & decrement behavior
        $cart->items()->firstOrCreate(['product_id' => $request->product_id, 'quantity' => 1]);
        return redirect(route('client.cart.get'))
            ->with('success-message', __('messages.product-added'));
    }

    public function removeItem(RemoveItemRequest $request) {
        $cart = Cart::where(['user_id' => auth()->user()->id])->first();
        $cart->items()->where('product_id', $request->product_id)->delete();
        return redirect()->back()->with('success-message', __('messages.product-removed'));
    }

    public function checkout(CheckoutRequest $request) {
        $user = auth()->user()->load('cart.items.product');
        try {
            $orderServiceInvoker = new OrderService($user, $request);
            if ($orderServiceInvoker()) {
                $user?->cart?->items()->delete();
            }
            return redirect(route("client.home"))
                ->with('success-message', __('messages.order-placed'));
        } catch (\Exception | \Error $e) {
            return redirect()->back()->with('error-message', $e->getMessage());
        }
    }
}
