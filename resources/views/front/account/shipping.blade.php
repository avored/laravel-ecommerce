@extends('mage2::front.master')

@section('content')
    <h1>User Shipping Address</h1>
    <div class="row">

        @include('mage2::front.account._menu')
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">User Shipping Address</div>
                <div class="panel-body">
                    <div class="pull-right">
                        <a href="{!! url('customer/account/shipping/add') !!}"
                           class="btn btn-primary"
                           title="Create Billing Address">Add Shipping Address
                        </a>
                    </div>

                    <br/>
                    <hr/>

                    @foreach($shippings as $shipping)
                        <div class="well col-md-6">
                            <div class="pull-right">
                                <a href="{!! url('/customer/account/shipping/' . $shipping->id . '/edit') !!}">Edit</a>
                            </div>
                            <p>{{ $shipping->number }}</p>
                            <p>{{ $shipping->street }}</p>
                            <p>{{ $shipping->area }}</p>
                            <p>{{ $shipping->city }}</p>
                            <p>{{ $shipping->state }}</p>
                            <p>{{ $shipping->zip_code }}</p>
                            <p>{{ $shipping->country }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
@endsection