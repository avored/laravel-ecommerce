@extends('layouts.admin')

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="main-title-wrap">
                    <span class="title">
                        Create Product Attribute
                    </span>
                </div>
                {!! Form::open(['method' => 'post','action' => route('admin.attribute.store')]) !!}
                    @include('admin.catalog.attribute._fields')
                    {!! Form::submit('Create Attribute') !!}
                {!! Form::close() !!}
            </div>
        </div>
@endsection