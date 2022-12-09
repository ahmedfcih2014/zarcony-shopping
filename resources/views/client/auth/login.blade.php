@extends('client.layout.base')

@section('content')
    <main>
        @include('client.layout.intro-section')
        <div class="album bg-light py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form method="POST" action="{{ route('client.auth.login') }}">
                    @csrf
                    @if($msg = session()->get("error-message"))
                        <div class="alert alert-danger"> {{ $msg }} </div>
                    @endif
                    <div class="mb-3">
                        <label class="form-label">Email / Mobile</label>
                        <input type="text" name="username"
                               value="{{ old("username") }}"
                               class="form-control @error('username') is-invalid @enderror"
                               placeholder="...">
                        @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="********">
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            <input type="checkbox" name="remember"> Remember Me
                        </label>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-dark" style="color: white; width: 100%">Login</button>
                    </div>
                </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
