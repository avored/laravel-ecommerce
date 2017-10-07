@extends('mage2-ecommerce::admin.layouts.app')

@section('content')
@section('content')
    <div class="row justify-content-center" >
        <div class="col-8">
            <div class="card ">
            <div class="card-header text-white bg-primary">
                Edit Product Attribute
            </div>
            <div class="card-body">
            {!! Form::bind($attribute, ['method' => 'PUT', 'action' => route('admin.attribute.update', $attribute->id)]) !!}

            @include('mage2-attribute::attribute._fields')

            {!! Form::submit('Update Attribute') !!}
            {!! Form::button('Cancel',['class' => 'btn', 'onclick' => 'location="'.route('admin.attribute.index').'"']) !!}

            {!! Form::close() !!}
            </div>
            </div>

        </div>
    </div>
@endsection