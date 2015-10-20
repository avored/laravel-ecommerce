@extends('admin.master')

@section('content')

    <div class="content">
        <h1>Category List</h1>
        <hr/>
        <div class="pull-right">
            <a href="{{ @url('/admin/category/create') }}" class="btn btn-primary" title="Add Category">
                Add Category
            </a>
            <br/><br/>
        </div>
        @if ( !$categories->count() )
            You have no Category
        @else


            <table class="table table-bordered table-hover">
                <tr>
                    <th>Id</th>
                    <th>name</th>
                    <th>slug</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                @foreach( $categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ ($category->status == "1") ? "Yes" : 'No' }}</td>
                        <td><a href="{{ route('admin.category.edit',$category->id) }}" title="Edit">Edit</a></td>
                        <td>
                            {!! Form::open(array('route' => array('admin.category.destroy', $category->id),
                                                                    'method' => 'DELETE' ,
                                                                    'id' => 'deleteForm')) !!}
                            <a href="#" onclick="jQuery(this).parents('form:first').submit()">Delete</a>
                            {!! Form::close() !!}

                        </td>
                    </tr>
                @endforeach
            </table>
        @endif
    </div>
@endsection