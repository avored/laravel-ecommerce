@extends('layouts.admin')

@section('header-title')
<h1>
    Category List
    <!--<small>Sub title</small> -->
</h1>
@endsection
@section('bread-crumb')
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li><a href="{{ route('admin.category.index') }}"><i class="fa fa-link"></i>Category</a></li>
        <li class="active">List</li>
    </ol>
@endsection

@section('content')
<div class="row">
    <div class="col s12">
        <div class="right">
            <a href="{{ route('admin.category.create') }}"
               class="btn btn-primary"> Create Category</a>
        </div>
        <div class="clearfix"></div>
        <br/>
        @if(count($categories) <= 0)

        <p>Sorry No Category Found</p>

        @else
        <table class="bordered">
            <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Slug</th>
            <th>Parent Category</th>
            <th>Website</th>
            <th>EDIT</th>
            <th>DELETE</th>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>

                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->slug }}</td>
                    <td>{{ $category->parent_name }}</td>
                    <td>{{ $category->website->name }}</td>

                    <td>
                        <a href="{{ route('admin.category.edit',$category->id )}}">Edit</a>
                    </td>
                    <td>
                        {!! Form::open(['method' => 'DELETE', 'route' => ['admin.category.destroy',$category->id]]) !!}
                        <a href="#" onclick="jQuery(this).parents('form:first').submit()">Delete</a>
                        {!! Form::close() !!}
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
@endsection

