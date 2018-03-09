<header>
    <nav class="navbar navbar-expand-lg navbar-inverse  bg-light">

        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">AvoRed</a>

        <ul class="nav navbar-nav mr-5 ml-auto">

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#"
                   id="navbarDropdown"
                   data-toggle="dropdown">
                    {{ Auth::guard('admin')->user()->first_name . " " .  Auth::guard('admin')->user()->last_name }}
                </a>
                <div class="dropdown-menu">

                    <a class="dropdown-item"
                       href="{{ route('admin.admin-user.show', Auth::guard('admin')->user()->id) }}">
                        My Account
                    </a>

                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item"
                       href="{{ route('admin.logout') }}">

                        Logout <i class="fa fa-sign-out" aria-hidden="true"></i>
                    </a>
                </div>
            </li>

        </ul>
    </nav>

</header>

