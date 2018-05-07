<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AvoRed Ecommerce') }}</title>

    <link href="{{ asset('vendor/avored-admin/css/app.css') }}" rel="stylesheet">


    <!-- Scripts -->
    <script>
        window.Laravel = <?php
        echo json_encode([
                'csrfToken' => csrf_token(),
        ]);
        ?>
    </script>
    @stack('styles')
</head>
<body>




<aside class="sidebar">
    @include("avored-ecommerce::layouts.left-nav")
</aside>
<div class="main-content">

    @include("avored-ecommerce::layouts.nav")


    <div class="container-fluid">
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
        {!! Breadcrumb::render(Route::getCurrentRoute()->getName()  ) !!}

        @yield('content')
    </div>

    @include('avored-ecommerce::layouts.footer')
</div>



<script src="{{ asset('vendor/avored-admin/js/app.js') }}"></script>
@stack('scripts')

</body>
</html>
