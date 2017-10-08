<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('meta_title', $metaTitle)</title>
    <meta name="description" content="@yield('meta_description', $metaDescription )"/>


    <link href="{{ asset('vendor/mage2-default/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/mage2-default/css/open-iconic-bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/mage2-default/css/star-rating.min.css') }}" rel="stylesheet">

    <link href="{{ asset('vendor/mage2-default/css/styles.css') }}" rel="stylesheet">

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
<script src="{{ asset('/vendor/mage2-default/js/jquery-3.2.1.slim.min.js') }}"></script>
<script src="{{ asset('/vendor/mage2-default/js/popper.min.js') }}"></script>
<script src="{{ asset('/vendor/mage2-default/js/bootstrap.min.js') }}"></script>


<script src="{{ asset('/vendor/mage2-default/js/star-rating.min.js') }}"></script>

@include("layouts.nav")
<div class="container">
    <div class="row">
        <div class="col-12">
            @if(session()->has('notificationText'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>

                    <strong>Success!</strong> {{ session()->get('notificationText') }}

                </div>
            @endif
        </div>
    </div>
</div>

@yield('content')

@include('layouts.footer')
@stack('scripts')
</body>
</html>
