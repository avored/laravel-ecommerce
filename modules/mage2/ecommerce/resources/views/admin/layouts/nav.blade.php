

    <header class="admin-header bg-inverse navbar">
        <!--button class="navbar-toggler d-sm-none d-lg-none mr-auto" type="button">
            <span class="oi oi-menu"></span>
        </button-->
        <a class="navbar-brand" href="#"></a>
        <!--button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
            <span class="oi oi-menu"></span>
        </button-->

        <!--nav class="nav navbar navbar-nav d-md-down-none">


            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown link
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>

            <li class="nav-item px-3">
                <a class="nav-link" href="#">Users</a>
            </li>
            <li class="nav-item px-3">
                <a class="nav-link" href="#">Settings</a>
            </li>
        </nav-->

        <ul class="nav navbar-nav ml-auto">

            <li class="nav-item px-3">
                <a class="nav-link" href="{{ route('admin.logout') }}">
                    <span class="oi oi-account-logout"></span>
                </a>
            </li>

        </ul>
    </header>