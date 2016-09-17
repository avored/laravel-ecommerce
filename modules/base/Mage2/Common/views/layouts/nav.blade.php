<nav class="light-blue  lighten-1" role="navigation">
    <div class="nav-wrapper ">
        <a id="logo-container" href="{{ route('home') }}" class="brand-logo">Mage2</a>


        <ul class="right hide-on-med-and-down">

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
        </ul>
        
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
</nav>