<ul class="list-group">
    @if(isset($adminMenus))
    @foreach($adminMenus as $key => $menu)
        @if(count($menu->subMenu()) > 0)
            <?php $subMenu = $menu->subMenu(); ?>
            <div class="side-nav-accordion">
                <?php
                $menu->menuClass();
                ?>

                <a class="list-group-item list-group-item-action side-nav-dropdown"  href="#">{{ $menu->label() }}
                    <span class="caret"></span>
                </a>

                <div class="list-group-sub-items-list {{ $menu->menuClass() }} ">

                    @foreach($subMenu as $subKey => $subMenuObj)
                        <a class="list-group-item pl-5 list-group-item-action"
                           href="{{ route($subMenuObj->route()) }}">{{ $subMenuObj->label() }}</a>
                    @endforeach
                </div>
            </div>
        @else
            <a class="list-group-item list-group-item-action " href="
                @if("#" == $menu->route())
                    #
                @else
                    {{ route($menu->route()) }}
                @endif
                ">
                {{ $menu->label() }}
            </a>
        @endif
    @endforeach
    @endif
</ul>

@push('scripts')
<script>
    $(function() {
        $(document).on('click','.side-nav-accordion .side-nav-dropdown',function(e) {
            e.preventDefault();
            jQuery(this).parents(".side-nav-accordion:first").find('.list-group-sub-items-list').toggleClass('d-none');
        })
    });
</script>
@endpush