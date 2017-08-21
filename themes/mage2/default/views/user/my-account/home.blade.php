@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="row profile">
        <div class="col-2">
            @include('user.my-account.sidebar')
        </div>
        <div class="col-10">

            <div class="card">
                <div class="card-header">
                    Profile Details Panel
                </div>
                <div class="card-body">

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
    </div>
@endsection
