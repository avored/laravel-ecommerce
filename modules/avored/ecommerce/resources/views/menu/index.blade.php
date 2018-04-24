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
                            <li class="list-group-item mb-2">
                                <i class="fas fa-bars"></i>
                                <a href="#" data-url="{{ route('category.view', $category->slug) }}">{{ $category->name }}</a>
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

                    </ul>
                </div>
            </div>

        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(function () {
            $("ul.front-menu").sortable({
                nested: true,
                group: "front-menu",
                onDragStart: function ($item, container, _super) {
                    // Duplicate items of the no drop area
                    if(!container.options.drop)
                        $item.clone().insertAfter($item);
                    _super($item, container);
                }
            });

            $("ul.left-menu").sortable({
                nested: false,
                group: "front-menu",
                drag: true,
                drop: false
            });


        });
    </script>
@endpush