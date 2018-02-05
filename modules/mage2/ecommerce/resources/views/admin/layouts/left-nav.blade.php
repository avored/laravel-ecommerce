<ul class="side-nav">
    @if(isset($adminMenus))
    @foreach($adminMenus as $key => $menu)
        @if(count($menu->subMenu()) > 0)
            <?php $subMenu = $menu->subMenu(); ?>

                <?php
                $menu->menuClass();
                ?>

            <li class="nav-item has-dropdown">
                <a class="has-submenu nav-link"  href="#"><i class="{{ $menu->icon() }}"></i> {{ $menu->label() }}

                    <span class="caret"></span>
                </a>

                <ul class="sub-nav d-none">

                    @foreach($subMenu as $subKey => $subMenuObj)
                        <li class="nav-item">

                        <a class="nav-link pl-5 list-group-item-action"
                           href="{{ route($subMenuObj->route()) }}"><i class="{{ $subMenuObj->icon() }}"></i>  {{ $subMenuObj->label() }}</a>
                        </li>
                    @endforeach

                </ul>
            </li>

        @else
            <li class="nav-item">

            <a class="nav-link " href="
                @if("#" == $menu->route())
                    #
                @else
                    {{ route($menu->route()) }}
                @endif
                ">
                <i class="{{ $menu->icon() }}"></i>
                {{ $menu->label() }}
            </a>
            </li>
        @endif
    @endforeach
    @endif
</ul>

@push('scripts')
<script>
    $(function() {
        $(document).on('click','.has-submenu',function(e) {
            e.preventDefault();
            jQuery(this).parents("li:first").find('.sub-nav:first').toggleClass('d-none');

        });
    });
</script>
@endpush