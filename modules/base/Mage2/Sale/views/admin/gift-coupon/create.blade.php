@extends('layouts.admin')


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Create Gift Coupon</div>
                <div class="panel-body">

                    {!! Form::open(['action' =>  route('admin.gift-coupon.store'),'method' => 'POST']) !!}
                    @include('mage2saleadmin::gift-coupon._fields')

                    <div class="input-field">
                        {!! Form::submit("Create Gift Coupon",['class' => 'btn btn-primary']) !!}
                        {!! Form::button("cancel",['class' => 'btn disabled','onclick' => 'location="' . route('admin.gift-coupon.index'). '"']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection