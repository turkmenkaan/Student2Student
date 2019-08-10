<!DOCTYPE html>
<html>
    <head>
        <title>{{ env('APP_NAME') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
        @yield('styles')
        <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    </head>
    <body>

        @yield('navbar')

        @if (session('danger'))
            <div class="columns" style="margin-top: 1%;">
                <div class="column is-10 is-offset-1">
                    <div class="notification is-danger">
                        {{ session('danger') }}
                    </div>
                </div>
            </div>
        @endif

        <div id="app">
            <div class="content">
                @yield('content')
            </div>
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/registerTeacher.js') }}"></script>

        @yield('script')

    </body>
</html>