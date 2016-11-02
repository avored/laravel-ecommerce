@extends('layouts.admin-bootstrap')

@section('content')
<div class="row">
    <div class="col-md-12">
    <div class="main-title-wrap">
        <span class="title">
            Page List
            <!--<small>Sub title</small> -->
        </span>
        <div class="pull-right" style="margin: 1rem 0px;">
            <a href="{{ route('admin.page.create') }}"
               class="btn btn-primary"> Create Page</a>
        </div>

    </div>


        <div class="clearfix"></div>
        <br/>
        @if(count($pages) <= 0)

        <p>Sorry No Page Found</p>

        @else
        
        <table class="table bordered tablegrid">
            <thead>
            <th>ID</th>
            <th>Title</th>
            <th>Slug</th>
            <th>Meta Title</th>

            <th>EDIT</th>
            <th>DELETE</th>
            </thead>
            <tbody>
                @foreach($pages as $page)
                <tr>
                    <td>{{ $page->id }}</td>
                    <td>{{ $page->title }}</td>
                    <td>{{ $page->slug }}</td>
                    <td>{{ $page->meta_title}}</td>
                    <td>
                        <a href="{{ route('admin.page.edit',$page->id )}}">Edit</a>
                    </td>
                    <td>
                        {!! Form::open(['method' => 'DELETE', 'action' => route('admin.page.destroy',$page->id)]) !!}
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

