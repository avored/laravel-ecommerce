<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AvoRed an Laravel E commerce') }}</title>
    <link rel="shortcut icon" href="/favicon.png">
    <!-- Scripts -->
    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <!-- Styles -->
    @if(env('APP_ENV') === 'testing1' && file_exists(public_path('mix-manifest.json')))
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @else
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @endif
    {{-- <script src="https://js.stripe.com/v3/"></script> --}}
</head>
<body>
    <div id="app">
        <avored-layout inline-template>
            <div class="">
                <div>
                    @include('partials.nav')
                    <div class="my-5 container mx-auto">
                        @yield('breadcrumb')
                        <div class="bg-white">
                            <div class="flex">
                                <div class="w-40 bg-white shadow overflow-hidden sm:rounded-lg text-center">
                                    @include('partials.account-nav')
                                </div>
                                <div class="flex-1 ml-5">
                                    <div>
                                        
                                    </div>
                                    @yield('content')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div  class="border-t">
                    @include('partials.footer')
                </div>
            </div>
        </avored-layout>
    </div>
   
    @if(env('APP_ENV') === 'testing1' && file_exists(public_path('mix-manifest.json')))
        <script src="{{ mix('js/avored.js') }}"></script>
    @else
        <script src="{{ asset('js/avored.js') }}"></script>
    @endif
    
    @stack('scripts')
    
    @if(env('APP_ENV') === 'testing1' && file_exists(public_path('mix-manifest.json')))
        <script src="{{ mix('js/app.js') }}"></script>
    @else
        <script src="{{ asset('js/app.js') }}"></script>
    @endif
</body>
</html>
