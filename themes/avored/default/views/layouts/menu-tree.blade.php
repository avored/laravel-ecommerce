@foreach($menus as $menu)
    <li class="nav-item">


        @php
            if($menu->params == null || $menu->params == "") {
                $url = route($menu->route);
            } else {
                $url = route($menu->route, $menu->params);
            }
        @endphp

        @if($menu->route == "cart.view")
            <a class="nav-link" href="{{ $url }}">
                {{ $menu->name }} <span class="badge badge-primary fill">{{ Cart::count() }}</span>
            </a>
        @else

            <a class="nav-link" href="{{ $url }}">
                {{ $menu->name }}
            </a>
        @endif
        

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

@push('styles')
<style>

    .main-navbar li {
        position: relative !important;
    }
    

</style>
@endpush

@push('scripts')
    <script>
        jQuery(document).ready(function() {
            $('ul.main-navbar li.nav-item').hover(function() {
                
                $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn(300);
            }, function() {
                $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeOut(300);
            });
        });

    </script>

@endpush
