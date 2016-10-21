@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col s12">
    <div class="main-title-wrapper">
        <h1>
            User List
            <!--<small>Sub title</small> -->
        </h1>
        <div class="right">
            <a href="{{ route('admin.user.create') }}"
               class="btn btn-primary"> Create User</a>
        </div>

    </div>


        <div class="clearfix"></div>
        <br/>
        @if(count($users) <= 0)

        <p>Sorry No User Found</p>

        @else
        
        <table class="table bordered tablegrid">
            <thead>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>EDIT</th>
            <th>DELETE</th>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ route('admin.user.edit',$user->id )}}">Edit</a>
                    </td>
                    <td>
                        {!! Form::open(['method' => 'DELETE', 'route' => ['admin.user.destroy',$user->id]]) !!}
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

