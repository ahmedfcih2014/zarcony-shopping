<?php

namespace App\Http\Controllers\Admin;

use App\Enum\OrderEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Order\ChangeStateRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index() {
        $orders = Order::latestId()->filter()->with('client', 'paymentMethod')->simplePaginate();
        $states = OrderEnum::getStatesKeyValue();
        $stateValues = [
            'paid' => OrderEnum::paid_status,
            'pending' => OrderEnum::pending_status,
            'canceled' => OrderEnum::canceled_status,
        ];
        return view('admin.orders.index', ['orders' => $orders, 'states' => $states, 'stateValues' => $stateValues]);
    }

    public function changeState(Order $order, ChangeStateRequest $request) {
        $order->update(['order_status' => $request->state]);
        return redirect()->back()
            ->with(
                'success-message',
                __('messages.order-state-changed', ['id' => $order->id, 'state' => $request->state])
            );
    }

    public function show(Order $order) {
        $order = $order->load('client', 'items.product', 'paymentMethod', 'invoice');
        return view('admin.orders.show', ['order' => $order]);
    }
}
