<header>
    <nav class="navbar navbar-expand-lg navbar-inverse  bg-light">

        <ul class="nav navbar-nav mr-5 ml-auto">

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#"
                   id="navbarDropdown"
                   data-toggle="dropdown">
                    <i class="fas fa-user-circle"></i>
                    {{ Auth::guard('admin')->user()->first_name . " " .  Auth::guard('admin')->user()->last_name }}
                </a>
                <div class="dropdown-menu">

                    <a class="dropdown-item"
                       href="{{ route('admin.admin-user.show') }}">
                        <i class="fas fa-user-circle"></i>
                        My Account
                    </a>

                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item"
                       href="{{ route('admin.logout') }}">

                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </a>
                </div>
            </li>

        </ul>
    </nav>

</header>

