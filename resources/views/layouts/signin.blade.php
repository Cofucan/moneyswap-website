<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <title>@yield('page_title') | {{ config('app.name') }}</title>

    <link href="{{ asset($portal->favicon) }}" rel="icon">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?sponsor=Nunito" rel="stylesheet">



    <!-- Styles -->
    <link href="{{ asset ('fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/signin.css') }}">
    @stack('styles')
    @livewireStyles
</head>
<body>

    <div id="app">



        <main>
            @yield('content')


        </main>
    </div>
    @livewireScripts
    <!-- Scripts -->
    {{-- <script src="{{ asset ('js/jquery-3.2.1.min.js')}}" defer></script> --}}
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/main.js')}}" defer></script>
    <script src="{{ asset('js/select2.js')}}"></script>
    <script>
      jQuery(document).ready(function($) {
        $('.select2').select2();

      });
    </script>
     @stack('scripts')
</body>
</html>
