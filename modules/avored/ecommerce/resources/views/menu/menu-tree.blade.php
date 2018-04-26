@foreach($menus as $menu)
    <li class="list-group-item mb-2"
        data-route="{{ $menu->route }}"
        data-params="{{ $menu->params }}"

        data-name="{{ $menu->name }}"
    >
        <i class="fas fa-bars"></i>
        <a href="#" data-p="">{{ $menu->name }}</a>
        <span class="float-right">
                <a href="#" class="destroy-menu"><i class="fas fa-trash"></i> </a>
            </span>

        @php
            $children = $menu->children();

        @endphp
        @if($children->count() > 0)

            <ul class="list-group">
                @include('avored-ecommerce::menu.menu-tree',['menus' => $children])
            </ul>
        @else

            <ul class="list-group"></ul>

        @endif

    </li>

@endforeach