@extends('avored-ecommerce::admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    Edit Gift Coupon</div>
                <div class="card-body">

                    <form action="{{ route('admin.gift-coupon.update', $model->id) }}" method="post">
                    {{ csrf_field() }}
                        <input type="hidden" name="_method" value="put">
                        @include('avored-ecommerce::admin.gift-coupon._fields')

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Update Gift Coupon</button>
                            <a href="{{ route('admin.gift-coupon.index') }}" class="btn">Cancel</a>
                        </div>
                    </form>


                </div>
            </div>

        </div>
    </div>
@endsection