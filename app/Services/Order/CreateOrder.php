<?php

namespace App\Services\Order;

use App\Enum\OrderEnum;
use App\Http\Requests\Client\Cart\CheckoutRequest;
use App\Models\Order;
use App\Models\User;

class CreateOrder
{
    private User $user;
    private CheckoutRequest $request;

    public function __construct(User $user, CheckoutRequest $request) {
        $this->user = $user;
        $this->request = $request;
    }

    public function __invoke() : Order
    {
        return Order::create([
            "user_id" => $this->user->id,
            "payment_method_id" => $this->request->payment_id,
            "order_status" => OrderEnum::pending_status,
            "address_line" => $this->request->address_line ?? "",
            "mobile" => $this->request->mobile ?? ""
        ]);
    }
}
