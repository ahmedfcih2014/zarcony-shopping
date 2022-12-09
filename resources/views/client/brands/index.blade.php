@extends('client.layout.base')

@section('content')
    <main>
        @include('client.layout.intro-section')
        <div class="album bg-light py-5">
            <div class="container">
                <div class="text-center mb-3 h5">
                    Shopping By Brand
                </div>
                <div class="row row-cols-1 row-cols-sm-3 row-cols-md-4 g-3">
                    @foreach($brands as $brand)
                        <div class="col">
                            <x-client.brand-card
                                name="{{ $brand->small_name }}"
                                url="{{ route('client.brands.products', ['brand' => $brand]) }}"
                            />
                        </div>
                    @endforeach
                </div>
                <div class="text-center mt-5">
                    {{ $brands->links() }}
                </div>
            </div>
        </div>
    </main>
@endsection
