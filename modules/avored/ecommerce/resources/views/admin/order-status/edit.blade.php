@extends('avored-ecommerce::admin.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        Edit OrderStatus
                    </div>
                    <div class="card-body">

                        <form action="{{ route('admin.order-status.update', $model->id) }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="put">


                            @include('avored-ecommerce::admin.order-status._fields')

                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Update Order Status</button>
                                <a href="{{ route('admin.order-status.index') }}" class="btn">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection