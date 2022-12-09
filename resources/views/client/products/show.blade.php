@extends('client.layout.base')

@section('content')
    <main>
        @include('client.layout.intro-section')
        <div class="album bg-light py-5">
            <div class="container">
                <h3>{{ $product->sku }}</h3>
                <h5>{{ $product->title }}</h5>
                {!! $product->details !!}
                <div class="d-flex flex-column justify-content-end gap-3 align-items-end mt-3">
                    <h5> {{ $product->price }} {{ __('words.USD') }} </h5>
                    <x-client.add-to-card/>
                </div>
            </div>
        </div>
    </main>
@endsection
