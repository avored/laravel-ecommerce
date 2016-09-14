@extends('layouts.admin')
@section('header-title')
<h1>
    Edit Category
    <!--<small>Sub title</small> -->
</h1>
@endsection
@section('bread-crumb')
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="{{ route('admin.category.index') }}"><i class="fa fa-link"></i>Category</a></li>
        <li class="active">Edit</li>
    </ol>
@endsection
@section('content')
        <div class="row">
            <div class="col s12">

                {!! Form::model($category, ['method' => 'PUT', 'route' => ['admin.category.update', $category->id]]) !!}
                        @include('category._fields')
                    
                        @include('template.hidden',['key' => 'id'])
                        @include('template.submit',['label' => 'Update Category'])
                    
                {!! Form::close() !!}
            </div>
        </div>
@endsection