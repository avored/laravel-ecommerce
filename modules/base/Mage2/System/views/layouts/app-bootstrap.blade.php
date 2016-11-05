<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Mage2 Ecommerce') }}</title>

    <link href="{{ asset('vendor/mage2-basic/css/appscss.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/mage2-basic/css/appless.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/mage2-basic/css/jquery.rateyo.min.css') }}" rel="stylesheet">


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
<script src="{{ asset('/vendor/mage2-basic/js/all.js') }}"></script>
<script src="{{ asset('/vendor/mage2-basic/js/jquery.rateyo.min.js') }}"></script>
<script src="{{ asset('/vendor/mage2-basic/js/scripts.js') }}"></script>

<script src="//cdn.ckeditor.com/4.5.11/basic/ckeditor.js"></script>


@include("layouts.nav-bootstrap")
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(session()->has('notificationText'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                    <strong>Success!</strong> {{ session()->get('notificationText') }}

                </div>
            @endif
        </div>
    </div>

    @yield('content')
</div>
</body>
</html>
