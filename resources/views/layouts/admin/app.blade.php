<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0, user-scalable=yes">

    <title>Mage2 Ecommerce Framework</title>


    <link href="/css/materialize.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="/css/styles.css" rel="stylesheet" type="text/css" media="screen" />


</head>
<body>
@include('layouts.admin.nav')
<div class="container main-content">
        @yield('content')
</div>
@include('layouts.admin.footer')

<script src="/js/materialize.js"></script>
<script src="/js/jquery-1.12.4.js"></script>
<script src="/js/main.js"></script>


</body>
</html>
