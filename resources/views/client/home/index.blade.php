@extends('client.layout.base')

@push("custom-css")
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
    />
    <style>
        .swiper {
            width: 100%;
            height: 60px;
            margin-bottom: 20px;
        }

        .swiper-button-next:after, .swiper-button-prev:after {
            font-size: 25px;
            color: white;
        }
    </style>
@endpush

@section('content')
    <main>
        @include('client.layout.intro-section')
        <div class="album bg-light py-5">
            <div class="container">
                @if(count($brands) > 0)
                    @include("client.home.brands")
                @endif
                <div class="text-center mb-3 h5">
                    Shopping By Product
                </div>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    @foreach($products as $product)
                        <div class="col">
                            <x-client.product-card
                                id="{{ $product->id }}"
                                title="{{ $product->small_title }}"
                                sku="{{ $product->small_sku }}"
                                price="{{ $product->price }} USD"
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

@push("custom-javascript")
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.swiper', {
            // Optional parameters
            loop: true,
            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            slidesPerView: 5,
        });
    </script>
@endpush
