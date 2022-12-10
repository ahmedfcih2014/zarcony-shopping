@extends('admin.layout.base')

@section('title', __('words.brands'))

@section('content')
    @include("admin.layout.breadcrumb", ['links' => [
        ['url' => route("admin.home"), 'name' => __("words.dashboard")],
        ['url' => route("admin.orders.index"), 'name' => __("words.orders")],
        ['url' => '', 'name' => __("words.show-order"), 'is_active' => true],
    ]])
    <table class="table table-striped">
        <tr>
            <td> {{ __('words.client') }}: </td>
            <td> {{ $order->client->name }} </td>
            <td> {{ __('words.mobile') }}: </td>
            <td> {{ $order->client->mobile }} </td>
        </tr>
        <tr>
            <td> {{ __('words.order-address') }}: </td>
            <td> {{ $order->address_line }} </td>
            <td> {{ __('words.order-mobile') }}: </td>
            <td> {{ $order->mobile }} </td>
        </tr>
        <tr>
            <td> {{ __('words.state') }}: </td>
            <td colspan="3"> {{ $order->order_status }} </td>
        </tr>
        <tr>
            <td> {{ __('words.order-amount') }}: </td>
            <td> {{ $order->invoice->order_amount ?? "" }} </td>
            <td> {{ __('words.order-taxes') }}: </td>
            <td> {{ $order->invoice->tax_amount ?? "" }} </td>
        </tr>
        <tr>
            <td> {{ __('words.order-delivery') }}: </td>
            <td> {{ $order->invoice->delivery_fees ?? "" }} </td>
            <td> {{ __('words.order-total-amount') }}: </td>
            <td> {{ $order->invoice->total_amount ?? "" }} </td>
        </tr>
        <tr>
            <td colspan="4"> {{ __('words.order-items') }}: </td>
        </tr>
        @foreach($order->items ?? [] as $item)
            <tr>
                <td> {{ __('words.sku') }}: {{ $item->product->small_sku ?? "" }} </td>
                <td> {{ __('words.price') }}: {{ $item->price ?? "" }} </td>
                <td> {{ __('words.quantity') }}: {{ $item->quantity ?? "" }} </td>
                <td> {{ __('words.total') }}: {{ $item->total_amount ?? "" }} </td>
            </tr>
        @endforeach
    </table>
@endsection
