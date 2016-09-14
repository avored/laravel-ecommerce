@extends('layouts.admin')

@section('header-title')
<h1>
    Create Category
    <!--<small>Sub title</small> -->
</h1>
@endsection

@section('bread-crumb')
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="{{ route('admin.category.index') }}"><i class="fa fa-link"></i>Category</a></li>
        <li class="active">Create</li>
    </ol>
@endsection


@section('content')
        <div class="row">
            <div class="col s12">
                {!! Form::open(['route' => 'admin.category.store']) !!}
                    @include('category._fields')
                    @include('template.submit',['label' => 'Create Category'])
                    
                {!! Form::close() !!}
            </div>
        </div>
@endsection