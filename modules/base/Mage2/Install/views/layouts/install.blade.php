<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Mage2 Ecommerce') }}</title>

    <link href="{{ asset('/vendor/mage2-admin/css/appscss.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
            
    </script>


    <script src="{{ asset('/vendor/mage2-admin/js/all.js') }}"></script>
    <style>
        body {
            width: 100%;
            height: 100%;
        }
        .container-fluid {


        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;

        -ms-flex-align: center;
        -webkit-align-items: center;
        -webkit-box-align: center;
            justify-content: center;;
            align-items: center;
        }
        .installation-panel {
            width: 60%;

            text-align: center;
        }

    </style>
    <script>
        jQuery(document).ready(function() {
            jQuery('.container-fluid').height(jQuery(document).height())
        })
    </script>
</head>
<body>

<div class="container-fluid" style="height: 100%">
        @yield('content')
</div>

@stack('scripts')
@stack('styles')
</body>
</html>
