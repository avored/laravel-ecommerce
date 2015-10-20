@extends('mage2::front.master')

@section('content')
    <h1>User Billing Address</h1>
    <div class="row">

        @include('mage2::front.account._menu')
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">User Billing Address</div>
                <div class="panel-body">
                    <div class="pull-right">
                        <a href="{!! url('customer/account/billing/add') !!}"
                           class="btn btn-primary"
                           title="Create Billing Address">Add Billing Address
                        </a>
                    </div>

                    <br/>
                    <hr/>

                    @foreach($billings as $billing)
                        <div class="well col-md-6">
                            <div class="pull-right">
                                <a href="{!! url('/customer/account/billing/' . $billing->id . '/edit') !!}">Edit</a>
                            </div>

                            <p>{{ $billing->number }}</p>

                            <p>{{ $billing->street }}</p>

                            <p>{{ $billing->area }}</p>

                            <p>{{ $billing->city }}</p>

                            <p>{{ $billing->state }}</p>

                            <p>{{ $billing->zip_code }}</p>

                            <p>{{ $billing->country }}</p>


                        </div>
                    @endforeach


                </div>
            </div>
        </div>

    </div>
@endsection