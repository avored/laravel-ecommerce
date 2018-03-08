@extends('avored-ecommerce::admin.layouts.app')


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="h1">{{ __("avored-ecommerce::lang.product.create.text") }}</div>
        </div>
    </div>
    {!! Form::open(['files' => true,'action' => route('admin.product.store'),'method' => 'post','id' => 'product-save-form']) !!}
    <div class="row">


        <div class="col-3">
            <div class="list-group" id="myList" role="tablist">

                <a href="#basic" class="list-group-item list-group-item-action active" aria-controls="home"
                   role="tab" data-toggle="tab">
                    Basic
                </a>


                <a href="#images" class="list-group-item list-group-item-action" role="tab" data-toggle="tab">
                    Images
                </a>

                <a href="#inventory" class="list-group-item list-group-item-action" role="tab" data-toggle="tab">
                    Inventory
                </a>

                <a href="#seo" class="list-group-item list-group-item-action" role="tab" data-toggle="tab">
                    SEO
                </a>


                @foreach(Tabs::all() as $key => $tab)

                    <a role="tab" class="list-group-item list-group-item-action" data-toggle="tab"
                       href="#{{ $key }}">
                        {{ $tab->label }}
                    </a>

                @endforeach

            </div>
        </div>
        <div class="col-9">
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tab-pane" class="tab-pane active" id="basic">
                    @include('avored-ecommerce::admin.product.card.basic' )
                </div>
                <div role="tab-pane" class="tab-pane" id="images">
                    @include('avored-ecommerce::admin.product.card.images' )
                </div>
                <div role="tab-pane" class="tab-pane" id="inventory">
                    @include('avored-ecommerce::admin.product.card.inventory' )
                </div>
                <div role="tab-pane" class="tab-pane" id="seo">
                    @include('avored-ecommerce::admin.product.card.seo' )
                </div>

                @foreach(Tabs::all() as $key => $tab)

                    <div role="tab-pane" class="tab-pane" id="{{ $key }}">
                        @include($tab->view)
                    </div>
                @endforeach


            </div>
        </div>

    </div>
    {!! Form::submit('Create Product') !!}
    {!! Form::button('Cancel',['class' => 'btn', 'onclick' => 'location="'.route('admin.product.index').'"']) !!}

    {!! Form::close() !!}
@endsection