@extends('layouts.app')

@section('content')
<div class="row profile">
    <div class="col s2">
        @include('my-account.sidebar')
    </div>
    <div class="col s10">

        <div class="card card-default">
            <div class="card-content">
                <div class="card-title">
                    Profile Details Panel
                </div>

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

                    </tbody>


                </table>
            </div>
        </div>

    </div>
</div>
@endsection