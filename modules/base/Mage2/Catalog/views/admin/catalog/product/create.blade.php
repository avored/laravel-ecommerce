@extends('layouts.admin')


@section('content')
    <div class="row">
        <div class="main-title-wrap">
            <span class="title">Create Product</span>
        </div>

    </div>
        <div class="row">
            <div class="col s12">
                {!! Form::open(['action' => route('admin.product.store'),'method' => 'post']) !!}


                 
                @foreach($productAttributeGroups as $group)
                    @if($group->identifier == "image")
                        @include('admin.catalog.product.boxes.images' )
                    @else
                        @include('admin.catalog.product.panel',['group' => $group] )
                    @endif
                @endforeach

                <!--
                include('product.boxes.extra')
                    include('admin.product._fields',['productAttributes' => $productAttributes,
                                                    'websites' => $websites,
                                                    'categories' => $categories])
                
                -->
                {!! Form::submit('Create Product') !!}

                    
                {!! Form::close() !!}
            </div>
        </div>
@endsection