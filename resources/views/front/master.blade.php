<!doctype html>
<html>
<head>
    @include('front.includes.head')
</head>
<body>
<header class="container-fluid">
    @include('front.includes.header')
</header>
<div id="main" class="container-fluid">
    @yield('content')
</div>

<footer class="container-fluid">
    <h1>Footer Area</h1>
</footer>

</body>
</html>