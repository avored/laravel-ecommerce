<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <avored-layout inline-template>
            <div>
                <a-layout id="components-layout-demo-top" class="layout">
                    @include('partials.nav')

                    <a-layout-content style="padding: 0 50px">
                        @include('partials.breadcrumb')
                        <a-layout style="padding: 24px 0">
                            <a-layout-sider width="200">
                            @include('partials.account-nav')
                            </a-layout-sider>
                            <a-layout-content :style="{ padding: '0 24px', minHeight: '280px' }">
                            @yield('content')
                            </a-layout-content>
                        </a-layout>
                        </a-layout-content>
                    
                    @include('partials.footer')
                </a-layout>
            </div>
        </avored-layout>
    </div>
</body>
</html>
