
<nav class="navbar navbar-expand-lg   bg-site-color">

    <a class="navbar-brand text-white" href="{{ route('admin.dashboard') }}">
        Mage2 Admin
    </a>

    <button class="navbar-toggler" type="button"
            data-toggle="collapse" data-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('admin.logout') }}">
                    Logout
                </a>
            </li>
        </ul>
    </div>
</nav>