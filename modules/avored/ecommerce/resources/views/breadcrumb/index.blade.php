

    <ol class="breadcrumb">

        @if(isset($breadcrumb->parents) && $breadcrumb->parents->count() >0)
            @foreach($breadcrumb->parents as $parentBreadcrumb)
                <li class="breadcrumb-item"><a href="{{ route($parentBreadcrumb->route) }}">
                        {{  __("avored-ecommerce::breadcrumb.". $parentBreadcrumb->label) }}
                    </a>
                </li>
            @endforeach
        @endif
            <li class="breadcrumb-item active">{{ __("avored-ecommerce::breadcrumb.". $breadcrumb->label) }}</li>

            <!--
            if ($breadcrumb->url && !$loop->last)
                <li class="breadcrumb-item"><a href="{ $breadcrumb->url }}">{ $breadcrumb->label }}</a></li>
            else
                <li class="breadcrumb-item active">{ $breadcrumb->title }}</li>
            endif

            -->


    </ol>
