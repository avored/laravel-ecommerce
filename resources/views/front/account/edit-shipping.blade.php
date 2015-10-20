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
                        {!! Form::model($shipping,array('method' => 'PATCH', 'url' => url('customer/account/shipping', $shipping->id))) !!}
                        @include('.account._edit')

                        {!! Form::hidden('type','SHIPPING') !!}
                        {!! Form::hidden('id') !!}
                        {!! Form::close() !!}

                    </div>


                </div>
            </div>
        </div>

    </div>
@endsection