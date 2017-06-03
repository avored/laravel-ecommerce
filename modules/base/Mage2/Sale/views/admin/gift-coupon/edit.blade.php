@extends('layouts.admin')

@section('content')
        <div class="row">
            <div class="col-md-12">

                <div class="panel-default panel">
                    <div class="panel-heading">

                        Edit Gift Coupon
                        <!--<small>Sub title</small> -->

                    </div>
                    <div class="panel-body">

                        {!! Form::bind($giftCoupon, ['method' => 'PUT', 'action' => route('admin.gift-coupon.update', $giftCoupon->id)]) !!}
                        @include('mage2sale::admin.gift-coupon._fields')

                        {!! Form::submit("Update Gift Coupon",['class' => 'btn btn-primary']) !!}
                        {!! Form::button("cancel",['class' => 'btn disabled','onclick' => 'location="' . route('admin.gift-coupon.index'). '"']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>

            </div>
        </div>
@endsection