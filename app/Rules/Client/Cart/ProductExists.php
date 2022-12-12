<?php

namespace App\Rules\Client\Cart;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Contracts\Validation\InvokableRule;

class ProductExists implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        $product = Product::find($value);
        if (!$product) {
            $fail(__('messages.product-not-exists'));
        }
        $cart = Cart::where('user_id', auth()->user()->id)->first();
        if (!$cart->items()->where("product_id", $value)->exists()) {
            $fail(__("messages.product-not-in-cart", ['name' => $product->title]));
        }
    }
}
