<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Mage2 Ecommerce') }}</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">


        <!-- Scripts -->
        <script>
            window.Laravel = <?php
                echo json_encode([
                    'csrfToken' => csrf_token(),
                ]);
?>
        </script>

    </head>
    <body>
    <!-- Scripts -->
    <!-- JQuery -->
    <script src="{{ asset('/js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/materialize.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        <div class="container-fluid">
            @include("layouts.admin-nav")

            @yield('content')
        </div>

    </body>
</html>
