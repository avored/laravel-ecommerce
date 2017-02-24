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
                        @include('mage2catalog::admin.catalog.product.images' )
                    @else
                        @include('mage2catalog::admin.catalog.product.panel',['group' => $group] )
                    @endif
                @endforeach

                @include('admin.catalog.product.option');

                {!! Form::submit('Create Product') !!}

                    
                {!! Form::close() !!}
            </div>
        </div>
@endsection