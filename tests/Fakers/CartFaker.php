<?php

namespace Tests\Fakers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class CartFaker
{
    public static function create(User $client, Collection $products) {
        $cart = $client->cart ?? Cart::create(['user_id' => $client->id]);

        $products->each(function ($product) use (&$cart) {
            $cart->items()->create(["product_id" => $product->id, "quantity" => 1]);
        });

        return $cart->load('items.product');
    }
}
