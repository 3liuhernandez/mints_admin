<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }} - {{section()}}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    {{-- BS --}}
    <link rel="stylesheet" href="{{ asset("bs/css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{asset('bs/css/bootstrap-utilities.min.css')}}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <script src="{{ asset("js/jquery-3.6.0.min.js")}}"></script>


    {{-- BlockUI --}}
    <script src="{{ asset('jquery_blockui/jquery.blockUI.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('jquery_blockui/nprogress.css') }}">
    <script src="{{ asset('jquery_blockui/nprogress.min.js') }}"></script>

    @yield('head')
</head>
<body>

    @auth
        @include('layouts.components.navbar_top')
    @endauth

    @yield('content')

    <script src="{{ asset("bs/js/bootstrap.bundle.min.js")}}"></script>
    <script src="{{ asset("js/axios.min.js")}}"></script>
    <script src="{{ asset("js/sweetalert.min.js")}}"></script>
    <script src="{{ asset("js/app.js")}}"></script>

    @yield('foot')
</body>
</html>