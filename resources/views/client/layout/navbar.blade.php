<header>
    <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a href="{{ route('client.home') }}" class="navbar-brand d-flex align-items-center">
                <strong>{{ __('words.zarcony') }}</strong>
            </a>
            <div class="d-flex flex-row">
                @if(auth()->check() && auth()->user()->isClientAuth())
                    <a href="{{ route('client.auth.login') }}" class="btn btn-dark"> {{ __("words.cart") }} </a>
                    <form method="POST" action="{{ route("client.auth.logout") }}">
                        @csrf
                        <button class="btn btn-dark">{{ __("words.logout") }}: {{ auth()->user()->name }}</button>
                    </form>
                @else
                    <a href="{{ route('client.auth.login') }}" class="btn btn-dark">
                        {{ __("words.login") }}
                    </a>
                @endif
            </div>
        </div>
    </div>
</header>
