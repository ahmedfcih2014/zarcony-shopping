<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Zarcony Admin - @yield('title')</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
              rel="stylesheet"
              integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
              crossorigin="anonymous">
        <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
              integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
              crossorigin="anonymous"
              referrerpolicy="no-referrer" />
        @stack("custom-css")
    </head>
    <body>
        <div style="overflow-x: hidden; height: 100vh">
            <div class="row">
                <div class="col-2">
                    @include("admin.layout.sidebar")
                </div>
                <div class="col-10" style="overflow-y: scroll; height: 100vh">
                    <div style="display: flex; flex-direction: row; align-items: center; justify-content: end">
                        <p>Welcome {{ auth()->user()->name }}</p>
                        <form method="POST" action="{{ route("admin.logout") }}">
                            @csrf
                            <button class="btn btn-link">{{ __("words.logout") }}</button>
                        </form>
                    </div>
                    <div class="container mb-5">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
                crossorigin="anonymous"></script>
        <script src="{{ asset("assets/sweet-alert.js") }}"></script>
        @include("admin.layout.alerts")
        @stack("custom-javascript")
        <script>
            function confirmDelete(formId, hintMsg) {
                swal({
                    title: "{{ __('messages.delete-confirm-title') }}",
                    text: "{{ __('messages.delete-confirm-msg') }} " + hintMsg,
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        document.getElementById(formId).submit()
                    }
                });
            }
        </script>
    </body>
</html>
