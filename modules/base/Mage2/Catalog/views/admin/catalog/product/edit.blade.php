@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="main-title-wrap col-md-12">
            <span class="title">Edit Product</span>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">

            <?php 
            $productCategories = $product->categories()->get()->pluck('id')->toArray();
            $productWebsites = $product->websites()->get()->pluck('id')->toArray();
            
            ?>
            {!! Form::bind($product, ['method' => 'PUT', 'action' => route('admin.product.update', $product->id)]) !!}

            
            
            @foreach($productAttributeGroups as $group)
                @if($group->identifier == "image")
                    @include('admin.catalog.product.images' )
                @else
                    @include('admin.catalog.product.panel',['group' => $group] )
                @endif
            @endforeach

            @include('admin.catalog.product.option');

            
            <div class="input-field">
                {!! Form::submit("Update Product",['class' => 'btn btn-primary']) !!}
                {!! Form::button("Cancel",['class' => 'btn btn-default']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection