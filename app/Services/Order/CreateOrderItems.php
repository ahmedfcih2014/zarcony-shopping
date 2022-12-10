<?php

namespace App\Services\Order;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

class CreateOrderItems
{
    private Order $order;
    private Collection $cartItems;

    public function __construct(Order $order, Collection $cartItems) {
        $this->order = $order;
        $this->cartItems = $cartItems;
    }

    public function __invoke() {
        $this->cartItems->each(function ($item) {
            $this->order->items()->create([
                "product_id" => $item->product->id,
                "total_amount" => $item->quantity * $item->product->price,
                "price" => $item->product->price,
                "quantity" => $item->quantity
            ]);
        });
    }
}
