@extends('admin.layout.base')

@section('title', __('words.brands'))

@section('content')
    @include("admin.layout.breadcrumb", ['links' => [
        ['url' => route("admin.home"), 'name' => __("words.dashboard")],
        ['url' => route("admin.brands.index"), 'name' => __("words.brands")],
        ['url' => route("admin.brands.create"), 'name' => __("words.edit-brand"), 'is_active' => true],
    ]])
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-12 card-light p-3">
                <form method="POST" action="{{ route("admin.brands.update", ['brand' => $brand]) }}">
                    @csrf
                    @method("PUT")
                    @if($msg = session()->get("error-message"))
                        <div class="alert alert-danger"> {{ $msg }} </div>
                    @endif
                    <div class="mb-3">
                        <label class="form-label">{{ __("words.name") }}</label>
                        <input type="text" name="name"
                               value="{{ $brand->name }}"
                               class="form-control @error('name') is-invalid @enderror"
                               placeholder="...">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary">{{ __("words.edit-brand") }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
