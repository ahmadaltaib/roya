@include('js-localization::head')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        @yield('js-localization.head')
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="{{ asset('js/custom.js') }}" rel="javascript" type="text/javascript"></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/webLayout.css') }}" rel="stylesheet">
        <link href="{{ asset('font/css/font-awesome.min.css') }}" rel="stylesheet">
    </head>

    <body>

        <div id="app">
            @include('layouts/nav')

            <div class="main-container">
                @yield('content')
            </div>

            @include('layouts/footer')
        </div>
    </body>
</html>
