@extends('admin.layout.base')

@section('title', __('words.users'))

@section('content')
    @include("admin.layout.breadcrumb", ['links' => [
        ['url' => route("admin.home"), 'name' => __("words.dashboard")],
        ['url' => route("admin.users.index"), 'name' => __("words.users"), 'is_active' => true],
    ]])
    <div class="text-end">
        <a href="{{ route("admin.users.create") }}" title="{{ __('words.create-user') }}"
           class="btn btn-primary"> {{ __('words.create-user') }} </a>
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
                <th> {{ __('words.user_role') }} </th>
                <th> {{ __('words.name') }} </th>
                <th> {{ __('words.email') }} </th>
                <th> {{ __('words.actions') }} </th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td> {{ $user->id }} </td>
                    <td> {{ $user->user_role }} </td>
                    <td> {{ $user->name }} </td>
                    <td> {{ $user->email }} </td>
                    <td>
                        <div class="actions-container">
                            <a href="{{ route('admin.users.edit', ['user' => $user]) }}"
                                class="btn btn-primary" title="{{ __('words.edit') }}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form class="m-0" method="POST" id="delete-user-{{ $user->id }}"
                                  action="{{ route('admin.users.destroy', ['user' => $user]) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" title="{{ __('words.delete') }}"
                                    type="button"
                                    onclick="confirmDelete('delete-user-{{ $user->id }}', '({{ $user->name }})')">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
@endsection
