<form class="mb-0" id="change-order-{{ $state .'-'. $order }}"
      method="POST" action="{{ route('admin.orders.change-state', ['order' => $order]) }}">
    @csrf
    <input type="hidden" name="state" value="{{ $state }}">
    <button type="button"
        onclick="confirmFormAction('change-order-{{ $state .'-'. $order }}', '{{ $title }}', '{{ $confirmText }}')"
        class="btn btn-{{ $btnClass ?? 'light' }}" title="{{ $title ?? "" }}">
        <i class="fa fa-{{ $btnIconClass }}"></i>
    </button>
</form>
