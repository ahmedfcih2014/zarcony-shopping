@extends('client.layout.base')

@section('content')
    <main>
        <section class="py-5 text-center container">
            <div class="row pt-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">Zarcony Shopping</h1>
                    <p class="lead text-muted">Simple shopping cart built for Zarcony</p>
                </div>
            </div>
        </section>
        <div class="album bg-light py-5">
            <div class="container">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    @foreach($products as $product)
                        <div class="col">
                            <x-client.product-card
                                id="{{ $product->id }}"
                                title="{{ $product->small_title }}"
                                sku="{{ $product->small_sku }}"
                                url="{{ route('products.show', ['sku' => $product->sku, 'id' => $product->id]) }}"
                                details="{{ $product->small_details }}"/>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection
