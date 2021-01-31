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
            <div>
                @include('partials.nav')
                <div class="mt-5">
                    @include('partials.breadcrumb')
                    <div class="bg-white container mx-auto">
                        <div class="flex">
                            <div class="flex-1 ml-5">
                                <div>
                                    @yield('breadcrumb')
                                </div>
                                @yield('content')
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
