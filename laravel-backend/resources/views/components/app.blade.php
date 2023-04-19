<!doctype html>
<html>

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    @vite('resources/css/app.css')
</head>

<body class="antialiased bg-white">

    <x-avored-header />
    {{ $slot }}
    @vite('resources/js/app.js')
    <x-avored-footer />
</body>

</html>
