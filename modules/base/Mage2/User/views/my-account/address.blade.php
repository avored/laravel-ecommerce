@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row profile">
        <div class="col-md-2">
            @include('my-account.sidebar')
        </div>
        <div class="col-md-10">
            <div class="title">
                <span>Addresses</span>
                
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('my-account.address.create')}}" >Create Address</a>
                </div>
                <span class="clearfix"></span><br/>
            </div>
            @if(count($addresses) <= 0)
            <p>Sorry No Address Found</p>
            @else
            @foreach($addresses as $address)
            <div class="panel panel-default">
                <div class="panel-heading">
                    Profile Address
                    <span class="pull-right">
                        <a href="{{ route('my-account.address.edit', $address->id)}}">Edit</a>
                    </span>

                </div>
                <div class="panel-body">
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
                                <th>city</th>
                                <td> {{ $address->city}}</td>
                            </tr>
                            <tr>
                                <th>State</th>
                                <td> {{ $address->state}}</td>
                            </tr>
                            <tr>
                                <th>Country</th>
                                <td> {{ $address->country}}</td>
                            </tr>
                            <tr>
                                <th>phone</th>
                                <td> {{ $address->phone }}</td>
                            </tr>

                        </tbody>


                    </table>
                </div>
            </div>
            @endforeach

            @endif
        </div>
    </div>
</div>
@endsection