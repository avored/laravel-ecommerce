<nav class="navbar  navbar-default bg-primary">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
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

                    <?php
                    $menu1 = $menu;
                    //var_dump($menuKey);
                    //dd(array_values($menu));
                    $menu = array_values($menu)[0];
                    if (!isset($menu['route'])) {
                        //dd($menu);
                        continue;
                    }
                    ?>

                    <!-- can('hasPermission',[Mage2\User\Models\AdminUser::class,$menu['route']]) -->

                        @if(isset($menu['submenu']))
                            <li class="dropdown">
                                <a class="dropdown-toggle" href="#">{{ $menu['label'] }} <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    @foreach($menu['submenu'] as $subMenu)
                                        <?php
                                        //$subMenu1 = $subMenu;
                                        //$subMenu = array_values($subMenu)[0];
                                        //var_dump($subMenu);
                                        if (!isset($subMenu['route'])) {
                                            //continue;
                                            dd($subMenu1);

                                        }
                                        ?>

                                        <li><a href="{{ route($subMenu['route']) }}">{{ $subMenu['label'] }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li><a href="{{ route($menu['route']) }}">{{ $menu['label'] }}</a></li>
                        @endif

                    <!--
                    else
                        <li><a href="#" title="no permission">{{ $menu['label'] }}</a></li>
                    endcan
                    -->
                @endforeach
                <li><a href="{{ route('admin.logout') }}">Logout</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div>
</nav>
