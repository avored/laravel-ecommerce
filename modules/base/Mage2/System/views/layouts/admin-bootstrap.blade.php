<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Mage2 Ecommerce') }}</title>

        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="{{ asset('vendor/mage2-admin/css/appscss.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/mage2-admin/css/appless.css') }}" rel="stylesheet">


        <!-- Scripts -->
        <script>
            window.Laravel = <?php
echo json_encode([
    'csrfToken' => csrf_token(),
]);
?>
        </script>
        <style>
            .content-wrapper {
                margin: 20px 0px;
            }
        </style>
    </head>
    <body>
        <!-- Scripts -->
        <!-- JQuery -->
        <script src="{{ asset('/vendor/mage2-admin/js/all.js') }}"></script>
        <script src="{{ asset('/vendor/mage2-admin/js/scripts.js') }}"></script>

        <script src="//cdn.ckeditor.com/4.5.11/basic/ckeditor.js"></script>



        @include("layouts.admin-bootstrap-nav")
        <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        @if(session()->has('notificationText'))
                        <div class="chip notification">
                            {{ session()->get('notificationText') }}
                            <i class="close material-icons">close</i>
                        </div>
                        @endif
                    </div>
                </div>

            @yield('content')
        </div>




    </body>
</html>
