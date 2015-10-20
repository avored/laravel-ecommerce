@extends('admin.master')

@section('content')

    <div class="content">
        <h1>Category Edit Form</h1>

        <div class="add_form">
            {!! Form::model($category,array('method' => 'PATCH', 'files' => true ,'url' => url('/admin/category',$category->id)) ) !!}

            @include('admin.category._edit')

            {!! Form::hidden('id') !!}

            {!! Form::close() !!}

        </div>

    </div>
@endsection