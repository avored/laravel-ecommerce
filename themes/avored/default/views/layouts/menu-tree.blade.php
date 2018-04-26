@foreach($menus as $menu)
    <li class="nav-item">


        @php
            if($menu->params == null || $menu->params == "") {
                $url = route($menu->route);
            } else {
                $url = route($menu->route, $menu->params);
            }
        @endphp
        <a class="nav-link" href="{{ $url }}">
            {{ $menu->name }}
        </a>

        @php
            $children = $menu->children();

        @endphp
        @if($children->count() > 0)
            <ul class="dropdown-menu">
                @include('layouts.menu-tree',['menus' => $children])
            </ul>
        @endif

    </li>

@endforeach

