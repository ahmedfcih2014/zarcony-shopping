@extends('admin.layout.base')

@section('title', __('words.brands'))

@section('content')
    @include("admin.layout.breadcrumb", ['links' => [
        ['url' => route("admin.home"), 'name' => __("words.dashboard")],
        ['url' => route("admin.brands.index"), 'name' => __("words.brands"), 'is_active' => true],
    ]])
    <div class="text-end">
        <a href="{{ route("admin.brands.create") }}" title="{{ __('words.create-brand') }}"
           class="btn btn-primary"> {{ __('words.create-brand') }} </a>
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
                <th> {{ __('words.name') }} </th>
                <th> {{ __('words.actions') }} </th>
            </tr>
        </thead>
        <tbody>
            @foreach($brands as $brand)
                <tr>
                    <td> {{ $brand->id }} </td>
                    <td> {{ $brand->name }} </td>
                    <td>
                        <div style="display: flex; flex-direction: row; gap: 5px; justify-content: center; align-items: center">
                            <a href="{{ route('admin.brands.edit', ['brand' => $brand]) }}"
                                class="btn btn-primary" title="{{ __('words.edit') }}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form class="m-0" method="POST" id="delete-brand-{{ $brand->id }}"
                                  action="{{ route('admin.brands.destroy', ['brand' => $brand]) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" title="{{ __('words.delete') }}"
                                    type="button"
                                    onclick="confirmDelete('delete-brand-{{ $brand->id }}', '({{ $brand->name }})')">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $brands->links() }}
@endsection
