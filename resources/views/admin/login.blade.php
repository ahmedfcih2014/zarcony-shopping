<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('words.zarcony-admin') }} - {{ __('words.login') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
          rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
          crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-4 offset-4">
                <form method="POST" action="{{ route("admin.login-post") }}">
                    @csrf
                    @if($msg = session()->get("error-message"))
                        <div class="alert alert-danger"> {{ $msg }} </div>
                    @endif
                    <div class="mb-3">
                        <label class="form-label">{{ __('words.email') }}</label>
                        <input type="email" name="email"
                               value="{{ old("email") }}"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="name@example.com">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('words.password') }}</label>
                        <input type="password" name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="********">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            <input type="checkbox" name="remember"> {{ __('words.remember-me') }}
                        </label>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-info" style="color: white; width: 100%">{{ __('words.login') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>
</html>
