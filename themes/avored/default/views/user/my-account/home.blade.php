@extends('layouts.app')

@section('meta_title','My Account E commerce')
@section('meta_description','My Account E commerce')


@section('content')

    <div class="row profile">
        <div class="col-3">
            @include('user.my-account.sidebar')
        </div>
        <div class="col-9">

            <div class="card">
                <div class="card-header">
                    Profile Details Panel
                </div>
                <div class="card-body">

                    <div class="table-responsive" >
                    <table class=" table">
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
                        <tr>
                            <th>Tax No</th>
                            <td> {{ $user->tax_no }}</td>
                        </tr>

                        </tbody>


                    </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
