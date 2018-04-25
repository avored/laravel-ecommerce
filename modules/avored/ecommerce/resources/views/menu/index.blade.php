@extends('avored-ecommerce::admin.layouts.app')

@section('content')
    <div class="row">


        <div class="col-md-12">
            <div class="h1">Menu</div>

            <div class="row">

                <div class="col-md-6">

                    <div class="col-md-6">
                        <div class="h4">Categories List</div>

                        <ul class="left-menu list-group ">

                            @foreach($categories as $category)
                                <li class="list-group-item mb-2"
                                    data-url="{{ route('category.view', $category->slug) }}"

                                    data-name="{{ $category->name }}"
                                >
                                    <i class="fas fa-bars"></i>
                                    <a href="#"
                                       data-url="{{ route('category.view', $category->slug) }}">{{ $category->name }}</a>
                                    <span class="float-right">
                                    <a href="#" class="destroy-menu"><i class="fas fa-trash"></i> </a>
                                </span>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="h4">
                        Front Menu
                    </div>


                    <ul class="front-menu list-group border p-3">
                        @include('avored-ecommerce::menu.menu-tree')
                    </ul>

                <!--ul class="front-menu list-group border p-3">
                        @foreach($menus as $menu)
                    <li class="list-group-item mb-2"
                        data-url="{{ $menu->url }}"

                            data-name="{{ $menu->name }}"
                        >
                            <i class="fas fa-bars"></i>
                            <a href="#" data-url="">{{ $menu->name }}</a>
                            <span class="float-right">
                                    <a href="#" class="destroy-menu"><i class="fas fa-trash"></i> </a>
                                </span>
                            <ul class="list-group"></ul>
                        </li>

                        @endforeach
                        </ul-->
                </div>


            </div>

            <div class="col-md-12">
                <form action="{{ route('admin.menu.store') }}" class="mt-3" method="post">
                    @csrf
                    <input type="hidden" name="menu_json" id="menu-list" value=""/>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save Menu</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

@endsection

@push('scripts')
    <script>
        jQuery(function () {
            var frontMenu = jQuery("ul.front-menu").sortable({
                nested: true,
                group: "front-menu",
                onDragStart: function ($item, container, _super) {
                    // Duplicate items of the no drop area
                    if (!container.options.drop)
                        $item.clone().insertAfter($item);
                    _super($item, container);
                },
                onDrop: function ($item, container, _super) {
                    var data = frontMenu.sortable("serialize").get();

                    var jsonString = JSON.stringify(data, null, ' ');


                    jQuery('#menu-list').val(jsonString);
                    _super($item, container);
                }
            });

            jQuery(document).on('click', '.destroy-menu', function (e) {
                e.preventDefault();
                jQuery(e.target).parents('li:first').remove();

                var data = frontMenu.sortable("serialize").get();

                var jsonString = JSON.stringify(data, null, ' ');
                jQuery('#menu-list').val(jsonString);
                _super($item, container);
            });

            jQuery("ul.left-menu").sortable({
                nested: false,
                group: "front-menu",
                drag: true,
                drop: false
            });


        });
    </script>
@endpush