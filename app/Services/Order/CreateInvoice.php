<?php

namespace App\Services\Order;

use App\Models\Invoice;
use App\Models\Order;
use App\Models\PaymentMethod;

class CreateInvoice
{
    private Order $order;
    private PaymentMethod $payment;

    public function __construct(Order $order, PaymentMethod $payment) {
        $this->order = $order;
        $this->payment = $payment;
    }

    public function __invoke() {
        $deliveryFees = 50;// fixed for now most be changed
        $orderAmount = $this->order->items()->sum('total_amount');
        $paymentTax = $orderAmount * $this->payment->tax_percent / 100;

        Invoice::create([
            'order_id' => $this->order->id,
            "total_amount" => $orderAmount + $paymentTax + $deliveryFees,
            "order_amount" => $orderAmount,
            "delivery_fees" => $deliveryFees,
            "tax_amount" => $paymentTax
        ]);
    }
}
