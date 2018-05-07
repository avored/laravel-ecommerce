<div class="brand-nav">

    <i class="fas fa-bars nav-icon"></i>

    <span class="logo">AvoRed Admin</span>


</div>

<ul class="side-nav">
    @if(isset($adminMenus))
    @foreach($adminMenus as $key => $menu)
        @if(count($menu->subMenu()) > 0)
            <?php $subMenu = $menu->subMenu(); ?>

            <li class="nav-item has-dropdown">
                <a class="has-submenu nav-link"  href="#"><i class="{{ $menu->icon() }}"></i> {{ $menu->label() }}
                    <span class="float-right">
                        <i class="fas fa-angle-down"></i>
                    </span>

                </a>

                <ul class="sub-nav">

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
            var subNav = jQuery(this).parents("li:first").find('.sub-nav:first');

            if(jQuery(subNav).attr('data-open') == "true") {

                jQuery(subNav).slideUp(500,function() {

                    jQuery(this).parents('.has-dropdown:first').find('.has-submenu .float-right i').removeClass('fa-angle-up');
                    jQuery(this).parents('.has-dropdown:first').find('.has-submenu .float-right i').addClass('fa-angle-down');

                    jQuery(this).attr('data-open',false);
                    jQuery(this).css('display','none');
                });

            } else {
                jQuery(subNav).slideDown(500,function() {

                    jQuery(this).parents('.has-dropdown:first').find('.has-submenu .float-right i').removeClass('fa-angle-down');
                    jQuery(this).parents('.has-dropdown:first').find('.has-submenu .float-right i').addClass('fa-angle-up');

                    jQuery(this).css('display','block');
                    jQuery(this).attr('data-open','true');
                });
            }

        });
    });
</script>
@endpush