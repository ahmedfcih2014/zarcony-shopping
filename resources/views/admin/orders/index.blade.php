@extends('admin.layout.base')

@section('title', __('words.brands'))

@section('content')
    @include("admin.layout.breadcrumb", ['links' => [
        ['url' => route("admin.home"), 'name' => __("words.dashboard")],
        ['url' => route("admin.orders.index"), 'name' => __("words.orders"), 'is_active' => true],
    ]])
    <form>
        <div class="input-group">
            <select name="state" class="form-select"
                id="inputGroupSelect04" aria-label="Example select with button addon">
                <option value="" selected>{{ __('words.select-order-state') }}</option>
                @foreach(($states ?? []) as $state)
                    <option {{ ($_GET['state'] ?? "") == $state['key'] ? 'selected' : '' }}
                        value="{{ $state['key'] }}">
                        {{ $state['value'] }}
                    </option>
                @endforeach
            </select>
            <button class="btn btn-outline-secondary" type="submit">
                {{ __('words.search') }} <i class="fa fa-search"></i>
            </button>
        </div>
    </form>
    <table class="table table-striped">
        <thead>
        <tr>
            <th> {{ __('words.id') }} </th>
            <th> {{ __('words.client') }} </th>
            <th> {{ __('words.state') }} </th>
            <th> {{ __('words.payment') }} </th>
            <th> {{ __('words.actions') }} </th>
        </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td> {{ $order->id }} </td>
                    <td> {{ $order->client->name ?? "" }} </td>
                    <td> {{ $order->order_status }} </td>
                    <td> {{ $order->paymentMethod->name ?? "" }} </td>
                    <td class="d-flex gap-2">
                        <a href="{{ route('admin.orders.show', ['order' => $order]) }}"
                           title="{{ __('words.show-order') }}" class="btn btn-light">
                            <i class="fa fa-eye"></i>
                        </a>
                        <x-admin.change-order-state-form
                            state="{{ $stateValues['pending'] }}"
                            btnIconClass="exclamation"
                            order="{{ $order->id }}"
                            confirmText="{{ __('messages.order-state-will-change', ['id' => $order->id, 'state' => $stateValues['pending']]) }}"
                            title="{{ __('words.pending-order') }}"
                        />
                        <x-admin.change-order-state-form
                            state="{{ $stateValues['paid'] }}"
                            btnIconClass="check"
                            confirmText="{{ __('messages.order-state-will-change', ['id' => $order->id, 'state' => $stateValues['paid']]) }}"
                            order="{{ $order->id }}"
                            title="{{ __('words.paid-order') }}"
                        />
                        <x-admin.change-order-state-form
                            state="{{ $stateValues['canceled'] }}"
                            btnIconClass="times"
                            order="{{ $order->id }}"
                            confirmText="{{ __('messages.order-state-will-change', ['id' => $order->id, 'state' => $stateValues['canceled']]) }}"
                            title="{{ __('words.cancel-order') }}"
                        />
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
