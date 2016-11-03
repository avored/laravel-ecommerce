<nav class="navbar navbar-default">
    <div class="container">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">Mage2</a>

        </div>


        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


            <ul class="nav navbar-nav navbar-right">

            <li><a href="{{ url('/') }}">Home</a></li>
            @include('layouts.category-tree',['categories', $categories])
            <li><a href="{{ route('cart.view') }}">Cart ({{$cart}})</a></li>
            <li><a href="{{ route('checkout.index') }}">Checkout</a></li>
            @if (Auth::guest())
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
            @else
                <li>

                    <a href="#" class="dropdown-button"  data-activates="my-account-nav"  data-beloworigin="true" >
                        {{ Auth::user()->full_name }}
                    </a>

                    <ul id="my-account-nav" class="light-blue" style="display: none">
                        <li><a href="{{ route('my-account.home') }}">My Account</a></li>
                        <li><a href="{{ route('logout') }}">Logout</a></li>
                    </ul>
                </li>
            @endif

            <li><a href="{{ route('contact-us.get') }}">Contact Us</a></li>
        </ul>
            </div>

    </div>
</nav>