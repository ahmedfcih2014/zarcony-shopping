@extends('admin.layout.base')

@section('title', 'Dashboard')

@section('content')
    @include("admin.layout.breadcrumb", ['links' => [
        ['url' => route("admin.home"), 'name' => "Dashboard", 'is_active' => true],
    ]])
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ __('words.products-count') }}</h5>
                    <p class="card-text">{{ $stats['products'] ?? 0 }}</p>
                    <a href="{{ route("admin.products.index") }}"> {{ __('words.products') }} </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ __('words.brands-count') }}</h5>
                    <p class="card-text">{{ $stats['brands'] ?? 0 }}</p>
                    <a href="{{ route("admin.home") }}"> {{ __('words.brands') }} </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ __('words.clients-count') }}</h5>
                    <p class="card-text">{{ $stats['clients'] ?? 0 }}</p>
                    <a href="{{ route("admin.home") }}"> {{ __('words.clients') }} </a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ __('words.orders-count') }}</h5>
                    <p class="card-text">{{ $stats['orders'] ?? 0 }}</p>
                    <a href="{{ route("admin.home") }}"> {{ __('words.orders') }} </a>
                </div>
            </div>
        </div>
    </div>
@endsection
