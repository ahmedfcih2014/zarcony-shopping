@if(auth()->check() && auth()->user()->isClientAuth())
    <form method="post" action="{{ route('client.cart.add-item') }}">
        @csrf
        <input type="hidden" name="product_id" value="{{ $id }}">
        <button class="{{ $class ?? 'btn btn-dark' }}"> {{ __("words.add-to-cart") }} </button>
    </form>
@else
    <a href="{{ route('client.auth.login') }}" class="{{ $class ?? 'btn btn-dark' }}">
        {{ __("words.login") }}
    </a>
@endif
