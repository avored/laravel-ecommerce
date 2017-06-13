@extends('layouts.admin')


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Create Order Status</div>
                <div class="panel-body">

                    {!! Form::open(['action' =>  route('admin.order-status.store'),'method' => 'POST']) !!}
                    @include('mage2sale::admin.order-status._fields')

                    <div class="input-field">
                        {!! Form::submit("Create OrderStatus",['class' => 'btn btn-primary']) !!}
                        {!! Form::button("cancel",['class' => 'btn disabled','onclick' => 'location="' . route('admin.order-status.index'). '"']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection