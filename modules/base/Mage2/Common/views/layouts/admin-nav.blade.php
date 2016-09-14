<nav class="navbar navbar-dark navbar-fixed-top scrolling-navbar primary-color">

    <!-- Collapse button-->
    <button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#collapseEx">
        <i class="fa fa-bars"></i></button>

    <div class="container">

        <!--Collapse content-->
        <div class="collapse navbar-toggleable-xs" id="collapseEx">
            <!--Navbar Brand-->
            <a class="navbar-brand waves-effect waves-light" href="" >Mage2 Admin</a>
            <!--Links-->
            <ul class="nav navbar-nav">
                
                @foreach($adminMenus as $menu) 
                <li class="nav-item">
                    <a class="nav-link waves-effect waves-light" href="{{ $menu['url'] }}">{{ $menu['label'] }}</a>
                </li>
                @endforeach
                @if (Auth::guard('admin')->guest())
                <li class="nav-item"><a class="nav-link waves-effect waves-light"  href="{{ url('admin.login') }}">Login</a></li>
                @else
                <li class="nav-item"><a class="nav-link waves-effect waves-light"  href="{{ route('admin.logout') }}">Logout</a></li>
                @endif

            </ul>

        </div>
        <!--/.Collapse content-->

    </div>

</nav>
