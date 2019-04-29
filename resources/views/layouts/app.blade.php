<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Using bootstrap to style my page. -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::to('css/custom.css') }}"> <!-- Custom CSS stylesheet -->
    <title>@yield('title')</title>
    @yield('styles')
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">


</head>

<body>

    @include('partials/navbar')


    @guest
    <!-- Adding a bar on top asking the guest to login -->
    <div class="alert alert-dark" role="alert">
        <div class="text-center">
            <h6>Please login to access all features of the system.</h6>
        </div>
    </div>
    @else
    <!-- If it is not a guest we still want some padding below the Navbar. -->
    <div style="margin-top: 20px;">

    </div>{}
    @endguest

    <div class="container">
        @include('partials.messages')
        @yield('content')
        <!-- Placed in a container because: each 'content' will have a grid, therefore each 'content' will be wrapped in this container-->
    </div>



    @yield('scripts')


</body>

</html>
