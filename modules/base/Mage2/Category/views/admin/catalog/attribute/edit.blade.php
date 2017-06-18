@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="main-title-wrap">
                    <span class="title">
                        Edit Product Attribute
                    </span>
            </div>

            {!! Form::bind($attribute, ['method' => 'PUT', 'action' => route('admin.attribute.update', $attribute->id)]) !!}

            @include('admin.catalog.attribute._fields')

            {!! Form::submit('Update Attribute') !!}
            {!! Form::button('Cancel',['class' => 'btn', 'onclick' => 'location="'.route('admin.attribute.index').'"']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection