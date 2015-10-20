@extends('admin.master')

@section('content')
    <div class="content">
        <h1>Category Add Form</h1>

        <div class="add_form">
            {!! Form::open(array('files' => 'true', 'url' => url('admin/category'))) !!}
            @include('admin.category._edit')
            {!! Form::close() !!}
        </div>
    </div>
@endsection