<nav class="" role="navigation">
    <div class="nav-wrapper ">
        <a id="logo-container" href="{{ route('admin.dashboard') }}" class="brand-logo">Mage2 Admin</a>
        <ul class="right hide-on-med-and-down">

            <!-- Authentication Links -->
            @foreach($adminMenus as $menu)
                <li><a href="{{ $menu['url'] }}">{{ $menu['label'] }}</a></li>
            @endforeach
            @if (Auth::guard('admin')->guest())
                <li><a href="{{ url('admin.login') }}">Login</a></li>
            @else
                <li><a href="{{ route('admin.logout') }}">Logout</a></li>
            @endif

        </ul>
        <ul id="nav-mobile" class="side-nav">

            <!-- Authentication Links -->
            @foreach($adminMenus as $menu)
                <li><a href="{{ $menu['url'] }}">{{ $menu['label'] }}</a></li>
            @endforeach
            @if (Auth::guard('admin')->guest())
                <li><a href="{{ url('admin.login') }}">Login</a></li>
            @else
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::guard('admin')->user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ route('admin.logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                    </ul>
                </li>
            @endif
        </ul>

        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
</nav>