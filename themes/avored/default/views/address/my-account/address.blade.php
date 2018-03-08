@extends('layouts.app')

@section('meta_title','My Address List Account E commerce')
@section('meta_description','My Address List Account E commerce')

@section('content')
        <div class="row profile">
            <div class="col-md-3">
                @include('user.my-account.sidebar')
            </div>

            <div class="col-9">
                <div class="main-title-wrap mb-3">
                    <span class="h1">Addresses</span>

                    <div class="float-right mr-3">
                        <a class="btn btn-primary" href="{{ route('my-account.address.create')}}">Create Address</a>
                    </div>

                </div>
                @if(count($addresses) <= 0)
                    <p>Sorry No Address Found</p>
                @else
                    <div class="row">
                        @foreach($addresses as $address)

                            <div class="col-6 mb-3">
                                <div class="card">
                                    <div class="card-header">
                                        @if($address->type == "SHIPPING")
                                            <span>Shipping Address</span>
                                        @else
                                            <span>Billing Address</span>
                                        @endif

                                        <span class="float-right">
                                            <a href="{{ route('my-account.address.edit', $address->id)}}">Edit</a>
                                        </span>

                                    </div>
                                    <div class="card-body ">
                                        <table class="table table-responsive">
                                            <tbody>
                                            <tr>
                                                <th>First Name</th>
                                                <td> {{ $address->first_name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Last Name</th>
                                                <td> {{ $address->last_name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Address1</th>
                                                <td> {{ $address->address1}}</td>
                                            </tr>
                                            <tr>
                                                <th>Address2</th>
                                                <td> {{ $address->address2}}</td>
                                            </tr>

                                            <tr>
                                                <th>City</th>
                                                <td> {{ $address->city}}</td>
                                            </tr>
                                            <tr>
                                                <th>State</th>
                                                <td> {{ $address->state}}</td>
                                            </tr>
                                            <tr>
                                                <th>Country</th>
                                                <td> {{ $address->country->name}}</td>
                                            </tr>
                                            <tr>
                                                <th>phone</th>
                                                <td> {{ $address->phone }}</td>
                                            </tr>

                                            </tbody>


                                        </table>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    </div>
                @endif
            </div>
        </div>

@endsection
