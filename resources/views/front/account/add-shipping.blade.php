@extends('mage2::front.master')

@section('content')
    <h1>User Shipping Address</h1>
    <div class="row">

        @include('mage2::front.account._menu')
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">User Shipping Address</div>
                <div class="panel-body">
                    <div class="">
                        {!! Form::open(array('url' => url('customer/account/shipping'))) !!}
                        @include('.account._edit-shipping')

                        {!! Form::hidden('type','SHIPPING') !!}
                        {!! Form::close() !!}

                    </div>


                </div>
            </div>
        </div>

    </div>
@endsection