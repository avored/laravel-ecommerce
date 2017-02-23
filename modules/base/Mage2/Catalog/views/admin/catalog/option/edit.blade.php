@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="main-title-wrap">
                    <span class="title">
                        Edit Product Option
                    </span>
            </div>

            {!! Form::bind($option, ['method' => 'PUT', 'action' => route('admin.option.update', $option->id)]) !!}
            @include('admin.catalog.option._fields')
            {!! Form::submit('Update Option') !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection