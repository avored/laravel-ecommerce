@extends('layouts.app')

@section('content')
    <div class="row profile">
        <div class="col-md-2">
            @include('user.my-account.sidebar')
        </div>
        <div class="col-md-10">

            <div class="panel panel-default">
                <div class="panel-heading">
                    Profile Details Panel
                </div>
                <div class="panel-body">

                    <table class="table table-responsive">
                        <tbody>
                        <tr>
                            <th>First Name</th>
                            <td> {{ $user->first_name }}</td>
                        </tr>
                        <tr>
                            <th>Last Name</th>
                            <td> {{ $user->last_name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td> {{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td> {{ $user->phone }}</td>
                        </tr>
                        <tr>
                            <th>Company Name</th>
                            <td> {{ $user->company_name }}</td>
                        </tr>

                        </tbody>


                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
