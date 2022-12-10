<?php

namespace App\Services\Order;

use App\Http\Requests\Client\Cart\CheckoutRequest;
use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Invoker
{
    private User $user;
    private CheckoutRequest $checkoutRequest;

    public function __construct(User $user, CheckoutRequest $request) {
        $this->user = $user;
        $this->checkoutRequest = $request;
    }

    public function __invoke() : bool {
        $paymentMethod = PaymentMethod::find($this->checkoutRequest->payment_id);
        try {
            DB::beginTransaction();

            $createOrderInvoker = new CreateOrder($this->user, $this->checkoutRequest);
            $order = $createOrderInvoker();

            $createOrderItemsInvoker = new CreateOrderItems($order, $this->user->cart->items);
            $createOrderItemsInvoker();

            $createInvoiceInvoker = new CreateInvoice($order, $paymentMethod);
            $createInvoiceInvoker();

            DB::commit();
            return true;
        } catch (\Exception | \Error $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
