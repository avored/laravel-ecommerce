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
            display:flex;
            justify-content: center;
            align-items: center;
        }
        .container-fluid {
           width: 100%;
        }
        .flex-row {
            width:100%;
        }


    </style>
</head>
<body>

<div class="container-fluid">
        @yield('content')
</div>
</body>
</html>
