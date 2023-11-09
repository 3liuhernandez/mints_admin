<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mints - {{section()}}</title>

    {{-- BS --}}
    <link rel="stylesheet" href="{{ asset("bs/css/bootstrap.min.css") }}">

    @yield('head')
</head>
<body>

    @auth
        @include('layouts.components.navbar_top')
    @endauth

    @yield('content')

    <script src="{{ asset("bs/js/bootstrap.bundle.min.js")}}"></script>
    <script src="{{ asset("js/axios.min.js")}}"></script>
    <script src="{{ asset("js/jquery-3.6.0.min.js")}}"></script>
    <script src="{{ asset("js/sweetalert.min.js")}}"></script>
    <script src="{{ asset("js/app.js")}}"></script>

    @yield('foot')
</body>
</html>