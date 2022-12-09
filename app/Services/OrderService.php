<?php

namespace App\Services;

use App\Enum\OrderEnum;
use App\Http\Requests\Client\Cart\CheckoutRequest;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Exception;
use Error;

class OrderService
{
    public static function placeOrder(User $user, CheckoutRequest $request) : bool {
        $paymentMethod = PaymentMethod::find($request->payment_id);
        try {
            DB::beginTransaction();
            $order = self::createOrder($user, $request);
            self::createOrderItem($user, $order);
            self::createInvoice($order, $paymentMethod);
            $user?->cart?->items()->delete();
            DB::commit();
            return true;
        } catch (Exception | Error $e) {
            DB::rollBack();
            return false;
        }
    }

    private static function createOrder(User $user, CheckoutRequest $request) : Order {
        return Order::create([
            "user_id" => $user->id,
            "payment_method_id" => $request->payment_id,
            "order_status" => OrderEnum::pending_status,
            "address_line" => $request->address_line ?? "",
            "mobile" => $request->mobile ?? ""
        ]);
    }

    private static function createOrderItem(User $user, Order $order) {
        $user?->cart?->items?->each(function ($item) use (&$order) {
            $order->items()->create([
                "product_id" => $item->product->id,
                "total_amount" => $item->quantity * $item->product->price,
                "price" => $item->product->price,
                "quantity" => $item->quantity
            ]);
        });
    }

    private static function createInvoice(Order $order, PaymentMethod $paymentMethod) : Invoice {
        $deliveryFees = 50;// fixed for now most be changed
        $orderAmount = $order->items()->sum('total_amount');
        $paymentTax = $orderAmount * $paymentMethod->tax_percent / 100;
        return Invoice::create([
            'order_id' => $order->id,
            "total_amount" => $orderAmount + $paymentTax + $deliveryFees,
            "order_amount" => $orderAmount,
            "delivery_fees" => $deliveryFees,
            "tax_amount" => $paymentTax
        ]);
    }
}
