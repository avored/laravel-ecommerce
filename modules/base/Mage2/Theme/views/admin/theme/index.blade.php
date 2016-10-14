@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col s12">
        <div class="main-title-wrapper">
            <h1>
                Theme List
                <!--<small>Sub title</small> -->
            </h1>
            <div class="right">
                <a href="{{ route('admin.theme.create') }}"
                   class="btn btn-primary">Create Theme</a>
            </div>
        </div>

        
        <div class="clearfix"></div>
        <br/>
        @if(count($themes) <= 0)

        <p>Sorry No Theme Found</p>

        @else
        
        <table class="table table-bordered table-responsive">
            <thead>
            <th>Name</th>
            <th>Description</th>
            <th>Action</th>
            <th>DELETE</th>
            </thead>
            <tbody>
                @foreach($themes as $theme)
                <tr>
                    <td>{{ $theme['name'] }}</td>
                    <td>{{ $theme['description'] }}</td>
                    <td>
                        <a href="{{ route('admin.theme.active',$theme['name'] )}}">Activate</a>
                    </td>
                    <td>
                        {!! Form::open(['method' => 'DELETE', 'route' => ['admin.theme.destroy',$theme['name']]]) !!}
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

