@extends('admin.layout.base')

@section('title', __('words.products'))

@section('content')
    @include("admin.layout.breadcrumb", ['links' => [
        ['url' => route("admin.home"), 'name' => __("words.dashboard")],
        ['url' => route("admin.products.index"), 'name' => __("words.products"), 'is_active' => true],
    ]])
    <div class="text-end">
        <a href="{{ route("admin.products.create") }}" title="{{ __('words.create-product') }}"
           class="btn btn-primary"> {{ __('words.create-product') }} </a>
    </div>
    <form>
        <input class="form-control mt-2" name="keyword"
               value="{{ $_GET['keyword'] ?? "" }}"
               placeholder="{{ __("words.search") }}">
    </form>
    <table class="table table-striped">
        <thead>
            <tr>
                <th> {{ __('words.id') }} </th>
                <th> {{ __('words.title') }} </th>
                <th> {{ __('words.sku') }} </th>
                <th> {{ __('words.actions') }} </th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td> {{ $product->id }} </td>
                    <td> {{ $product->title }} </td>
                    <td> {{ $product->sku }} </td>
                    <td>
                        <div class="actions-container">
                            <a href="{{ route('admin.products.edit', ['product' => $product]) }}"
                                class="btn btn-primary" title="{{ __('words.edit') }}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form class="m-0" method="POST" id="delete-product-{{ $product->id }}"
                                  action="{{ route('admin.products.destroy', ['product' => $product]) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" title="{{ __('words.delete') }}"
                                        type="button"
                                    onclick="confirmDelete('delete-brand-{{ $product->id }}', '({{ $product->title }})')">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $products->links() }}
@endsection
