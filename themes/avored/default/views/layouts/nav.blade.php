<nav class="navbar navbar-expand-md navbar-dark bg-red" style="padding:0;">
    <div class="container">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" target="_blank" href="https://github.com/avored/laravel-ecommerce">
                    <i class="fab fa-github"></i> GitHub
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" target="_blank" href="https://www.facebook.com/avored">
                    <i class="fab fa-facebook"></i> Facebook
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" target="_blank" href="https://twitter.com/avoredecommerce">
                    <i class="fab fa-twitter"></i> Twitter
                </a>
            </li>
        </ul>
        <ul class="navbar-nav">

            @auth()

                <li class="nav-item ">
                    <a class="nav-link" href="#">Welcome {{ Auth::user()->full_name }} !
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('my-account.home') }}">My Account
                        <span class="sr-only">(current)</span>
                    </a>
                </li>


            @endauth

            @guest()

            @if($currencies->count() > 1)
            <li class="nav-item dropdown" >
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
                    
                    Currency : {{ Session::get('currency_symbol')}}
                </a>
                    <div class="dropdown-menu">
                        @foreach($currencies as $siteCurrencyId => $currencyCode)
                        <?php 
                            if (strpos(URL::current(), '?')) {
                                $url = URL::current() . '&currency_code=' . $currencyCode;
                            } else {
                                $url = URL::current() . '?currency_code=' . $currencyCode;
                            }

                        ?>
                            <a class="dropdown-item" 
                                href="{{ $url }}">
                                {{ $currencyCode}}
                            </a>
                        @endforeach
                    </div>
               
            </li>
            @endif
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Sign In </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">Create an Account</a>
            </li>
            @endguest()

        </ul>
    </div>
</nav>

<header style="padding: 40px 0;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <span style="font-size: 32px; font-weight: 500; margin-top: 10px;">
                        <img src="{{ asset('vendor/avored-default/images/logo.svg') }}" alt="logo" class="logo">AvoRed Store
                    </span>
                </a>
            </div>
            <div class="col-md-6">
                <form class="navbar-form" action="{{ route('search.result') }}" method="get" role="search">
                    <div class="input-group" style="padding-top: 14px;">
                        <input type="text" class="form-control" placeholder="Search entire store here..." name="q">
                        <div class="input-group-btn">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <!--<div class="col-md-1">
                <a class="nav-link" href="http://demo.avored.website/cart/view">Cart (0)</a>
            </div>-->
        </div>
    </div>
</header>
   
<nav class="navbar navbar-expand-md navbar-light bg-light">
    <div class="container">
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse"
                data-target="#avored-navbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="avored-navbar">
            <ul class="main-navbar navbar-nav mr-auto">
                @include('layouts.menu-tree',['menus' => $menus])
            </ul>
        </div>
    </div>
</nav>
