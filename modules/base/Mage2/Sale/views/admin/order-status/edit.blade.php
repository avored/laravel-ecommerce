@extends('layouts.admin')

@section('content')
        <div class="row">
            <div class="col-md-12">

                <div class="panel-default panel">
                    <div class="panel-heading">

                        Edit OrderStatus
                        <!--<small>Sub title</small> -->

                    </div>
                    <div class="panel-body">

                        {!! Form::bind($orderStatus, ['method' => 'PUT', 'action' => route('admin.order-status.update', $orderStatus->id)]) !!}
                        @include('mage2sale::admin.order-status._fields')

                        {!! Form::submit("Update Order Status",['class' => 'btn btn-primary']) !!}
                        {!! Form::button("cancel",['class' => 'btn disabled','onclick' => 'location="' . route('admin.order-status.index'). '"']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>

            </div>
        </div>
@endsection