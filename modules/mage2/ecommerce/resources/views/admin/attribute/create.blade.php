@extends('mage2-ecommerce::admin.layouts.app')

@section('content')
    <div class="row justify-content-center" >
        <div class="col-8">
            <div class="card ">
                <div class="card-header text-white bg-primary">
                    Create Product Attribute
                </div>
                <div class="card-body">
                    {!! Form::open(['method' => 'post','action' => route('admin.attribute.store')]) !!}
                    @include('mage2-attribute::attribute._fields')
                    {!! Form::submit('Create Attribute') !!}
                    {!! Form::button('Cancel',['class' => 'btn', 'onclick' => 'location="'.route('admin.attribute.index').'"']) !!}
                    {!! Form::close() !!}
                </div>
            </div>

        </div>
    </div>
@endsection