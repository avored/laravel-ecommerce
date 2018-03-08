@extends('avored-ecommerce::admin.layouts.app')

@section('content')
    <div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header">Create Gift Coupon</div>
                <div class="card-body">


                    <form action="{{ route('admin.gift-coupon.store') }}" method="post">
                        {{ csrf_field() }}
                    @include('avored-ecommerce::admin.gift-coupon._fields')

                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Create Gift Coupon</button>
                        <a href="{{ route('admin.gift-coupon.index') }}" class="btn">Cancel</a>
                    </div>

                  </form>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection