@extends('admin.layout.base')

@section('title', __('words.users'))

@section('content')
    @include("admin.layout.breadcrumb", ['links' => [
        ['url' => route("admin.home"), 'name' => __("words.dashboard")],
        ['url' => route("admin.users.index"), 'name' => __("words.users")],
        ['url' => route("admin.users.create"), 'name' => __("words.edit-user"), 'is_active' => true],
    ]])
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-12 card-light p-3">
                <form method="POST" action="{{ route("admin.users.update", ['user' => $user]) }}">
                    @csrf
                    @method("PUT")
                    @if($msg = session()->get("error-message"))
                        <div class="alert alert-danger"> {{ $msg }} </div>
                    @endif
                    <div class="mb-3">
                        <label class="form-label">{{ __("words.name") }}</label>
                        <input type="text" name="name"
                               value="{{ $user->name }}"
                               class="form-control @error('name') is-invalid @enderror"
                               placeholder="...">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __("words.email") }}</label>
                        <input type="email" name="email"
                               value="{{ $user->email }}"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="...">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __("words.mobile") }}</label>
                        <input type="text" name="mobile"
                               value="{{ $user->mobile }}"
                               class="form-control @error('mobile') is-invalid @enderror"
                               placeholder="...">
                        @error('mobile')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __("words.password") }}</label>
                        <input type="password" name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="...">
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __("words.user_role") }}</label>
                        <select class="form-select @error('user_role') is-invalid @enderror"
                                name="user_role">
                            <option> {{ __("words.select-role") }} </option>
                            @foreach($roles as $role)
                                <option {{ $user->user_role == $role['key'] ? "selected" : "" }}
                                        value="{{ $role['key'] }}"> {{ $role['value'] }} </option>
                            @endforeach
                        </select>
                        @error('user_role')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary">{{ __("words.edit-user") }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
