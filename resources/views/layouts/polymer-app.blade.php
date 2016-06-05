<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1.0, user-scalable=yes">

    <title>Mage2 Ecommerce Framework</title>


    <!--<link rel="stylesheet" href="/css/reset.css">-->

    <!-- Styles
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}} -->


    <script src="/bower_components/webcomponentsjs/webcomponents-lite.js"></script>


    <link rel="import" href="/bower_components/paper-badge/paper-badge.html">
    <link rel="import" href="/bower_components/iron-flex-layout/iron-flex-layout-classes.html">
    
    <link rel="import" href="/bower_components/paper-fab/paper-fab.html">

    <link rel="import" href="/bower_components/paper-styles/color.html">
    <link rel="import" href="/bower_components/paper-styles/default-theme.html">
    <link rel="import" href="/bower_components/paper-styles/shadow.html">
    <link rel="import" href="/bower_components/paper-styles/typography.html">

    <link rel="import" href="/bower_components/iron-form/iron-form.html">
    <link rel="import" href="/bower_components/paper-input/paper-input.html">
    <link rel="import" href="/bower_components/paper-checkbox/paper-checkbox.html">

    <link rel="import" href="/bower_components/font-roboto/roboto.html">
    <link rel="import" href="/bower_components/iron-icons/iron-icons.html">
    <link rel="import" href="/bower_components/paper-item/paper-icon-item.html">
    <link rel="import" href="/bower_components/paper-card/paper-card.html">

    <link rel="import" href="/bower_components/paper-icon-button/paper-icon-button.html">
    <link rel="import" href="/bower_components/paper-button/paper-button.html">

    <link rel="import" href="/bower_components/app-layout/app-drawer-layout/app-drawer-layout.html">
    <link rel="import" href="/bower_components/app-layout/app-drawer/app-drawer.html">
    <link rel="import" href="/bower_components/app-layout/app-scroll-effects/app-scroll-effects.html">
    <link rel="import" href="/bower_components/app-layout/app-header/app-header.html">
    <link rel="import" href="/bower_components/app-layout/app-header-layout/app-header-layout.html">
    <link rel="import" href="/bower_components/app-layout/app-toolbar/app-toolbar.html">


    <link rel="import" href="/css/styles.html">

</head>
<body unresolved id="app-layout">

<app-header-layout>

    <app-drawer-layout id="drawerLayout">

        <app-drawer>
            <div class="drawer-content">
                @include('layouts.nav')
            </div>
        </app-drawer>

        <div class="container">
            @yield('content')
        </div>

    </app-drawer-layout>

    <app-header fixed effects="waterfall">
        <app-toolbar>
            <paper-icon-button id="toggle" icon="menu"></paper-icon-button>
            <a href="/">
                <div title>Mage2</div>
            </a>
        </app-toolbar>
    </app-header>

</app-header-layout>

<script>
    var drawerLayout = document.getElementById('drawerLayout');
    document.getElementById('toggle').addEventListener('tap', function () {
        if (drawerLayout.forceNarrow || !drawerLayout.narrow) {
            drawerLayout.forceNarrow = !drawerLayout.forceNarrow;
        } else {
            drawerLayout.drawer.toggle();
        }
    });
</script>


<!-- JavaScripts
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
-->
{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
