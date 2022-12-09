@if(auth()->check() && auth()->user()->isClientAuth())
    <button class="{{ $class ?? 'btn btn-dark' }}"> {{ __("words.add-to-cart") }} </button>
@else
    <a href="{{ route('client.auth.login') }}" class="{{ $class ?? 'btn btn-dark' }}"> Login </a>
@endif
