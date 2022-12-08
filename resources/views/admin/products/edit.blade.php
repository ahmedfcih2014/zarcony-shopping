@extends('admin.layout.base')

@section('title', __('words.products'))

@section('content')
    @include("admin.layout.breadcrumb", ['links' => [
        ['url' => route("admin.home"), 'name' => __("words.dashboard")],
        ['url' => route("admin.products.index"), 'name' => __("words.products")],
        ['url' => route("admin.products.create"), 'name' => __("words.edit-product"), 'is_active' => true],
    ]])
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-12 card-light p-3">
                <form method="POST" action="{{ route("admin.products.update", ['product' => $product]) }}">
                    @csrf
                    @method("PUT")
                    @if($msg = session()->get("error-message"))
                        <div class="alert alert-danger"> {{ $msg }} </div>
                    @endif
                    <div class="mb-3">
                        <label class="form-label">{{ __("words.brand") }}</label>
                        <select class="form-select @error('brand_id') is-invalid @enderror"
                                name="brand_id">
                            <option> {{ __("words.select-brand") }} </option>
                            @foreach($brands as $brand)
                                <option {{ $product->brand_id == $brand->id ? "selected" : "" }}
                                        value="{{ $brand->id }}"> {{ $brand->name }} </option>
                            @endforeach
                        </select>
                        @error('brand_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __("words.sku") }}</label>
                        <input type="text" name="sku"
                               value="{{ $product->sku }}"
                               class="form-control @error('sku') is-invalid @enderror"
                               placeholder="...">
                        @error('sku')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __("words.title") }}</label>
                        <input type="text" name="title"
                               value="{{ $product->title }}"
                               class="form-control @error('title') is-invalid @enderror"
                               placeholder="...">
                        @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __("words.price") }}</label>
                        <input type="text" name="price" value="{{ $product->price }}"
                               class="form-control @error('price') is-invalid @enderror"
                               placeholder="100.5">
                        @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __("words.details") }}</label>
                        <textarea type="text" name="details" rows="5"
                               class="form-control @error('details') is-invalid @enderror"
                                  placeholder="...">{{ $product->details }}</textarea>
                        @error('details')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary">{{ __("words.edit-product") }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
