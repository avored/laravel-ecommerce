@extends('layouts.app')

@section('content')
<div class="row profile">
    <div class="col s2">
        @include('my-account.sidebar')
    </div>
    <div class="col s10">
        <div class="main-title-wrapper">
            <h1>Addresses</h1>
            <div class="right">
                <a class="btn btn-primary" href="{{ route('my-account.address.create')}}" >Create Address</a>
            </div>
            <span class="clearfix"></span><br/><br/>
        </div>
        @if(count($addresses) <= 0)
        <p>Sorry No Address Found</p>
        @else
        @foreach($addresses as $address)
        <div class="col s6">
            <div class="card card-default">
                <div class="card-content ">
                    <div class="card-title">
                        @if($address->type == "SHIPPING")
                        <span>Shipping Address</span>
                        @else
                        <span>Billing Address</span>
                        @endif
                        <span class="right">
                            <a href="{{ route('my-account.address.edit', $address->id)}}">Edit</a>
                        </span>

                    </div>
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
                                <th>Area</th>
                                <td> {{ $address->area}}</td>
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

        @endif
    </div>
</div>
@endsection
