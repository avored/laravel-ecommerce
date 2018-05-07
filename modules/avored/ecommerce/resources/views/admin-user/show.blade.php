@extends('avored-ecommerce::layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            Account Details
            <a class="float-right" href="{{ route('admin.admin-user.edit', $user->id) }}">Edit</a>
        </div>

        <div class="card-body table-bordered">
            <table class="table">
                <tr>
                    <td>First Name</td>
                    <td>{{ $user->first_name }}</td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td>{{ $user->last_name }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <td>Role</td>
                    <td>{{ $user->role->name }}</td>
                </tr>
            </table>
        </div>
    </div>

@stop