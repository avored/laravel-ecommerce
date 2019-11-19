<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="/favicon.png">
    <!-- Scripts -->
    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('styles')
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    <div id="app">
        <avored-layout inline-template>
            <div>
                <a-layout id="components-layout-demo-top" class="layout">
                    @include('partials.nav')

                    <a-layout-content style="padding: 0 50px">
                    @include('partials.breadcrumb')
                    <div :style="{ background: '#fff', padding: '24px', minHeight: '280px' }">
                        @yield('content')
                    </div>
                    </a-layout-content>
                    
                    @include('partials.footer')
                </a-layout>
            </div>
        </avored-layout>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/review.js') }}"></script>
    @stack('scripts')
</body>
</html>
