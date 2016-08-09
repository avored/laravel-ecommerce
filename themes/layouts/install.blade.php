<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Crazy Ecommerce App - Installation</title>
        <!-- Fonts -->

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

        <!-- Styles -->
        <link rel="stylesheet" href="/css/all.css" >

        <style>
            body {
                font-family: 'Lato';
            }
        </style>

        <!-- JavaScripts -->
        <script src="/js/all.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC68duKDmlUM1tpolvwAcs_4VzcHDZMgno&libraries=places"></script>

    </head>
    <body id="app-layout">

        @yield('content')

    <script>
        jQuery(document).ready(function() {
            var height = jQuery('.panel-installation').height();
            var docHeight = jQuery(document).height();

            topMargin = (docHeight - height) / 2;
            jQuery('.panel-installation').css('margin-top', topMargin);

        });

    </script>


</body>
</html>
