<nav class="navbar navbar-default">
<div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Mage2 Admin</a>

        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @foreach($adminMenus as $menu)
                    @can('hasPermission',[Mage2\User\Models\AdminUser::class,$menu['route']])
                    <li><a href="{{ route($menu['route']) }}">{{ $menu['label'] }}</a></li>
                    @else
                    <li>{{ $menu['label'] }}</li>
                    @endcan
                @endforeach
                    <li><a href="{{ route('admin.logout') }}">Logout</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
</div>
</nav>
