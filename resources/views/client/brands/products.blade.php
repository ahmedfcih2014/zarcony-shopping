@extends('client.layout.base')

@section('content')
    <main>
        @include('client.layout.intro-section')
        <div class="album bg-light py-5">
            <div class="container">
                <div class="text-start mb-3 h5">
                    <a style="color: #525252" href="{{ route('client.brands.list') }}">{{ __('words.brands') }}</a> | {{ $brand->name }}
                </div>
                <div class="text-center mb-3 h5"> {{ __('words.shopping-product') }} </div>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    @foreach($products as $product)
                        <div class="col">
                            <x-client.product-card
                                id="{{ $product->id }}"
                                title="{{ $product->small_title }}"
                                sku="{{ $product->small_sku }}"
                                url="{{ route('client.products.show', ['id' => $product->id]) }}"
                                details="{{ $product->small_details }}"/>
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-5">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </main>
@endsection
