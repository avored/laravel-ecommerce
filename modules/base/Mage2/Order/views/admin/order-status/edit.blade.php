@extends('layouts.admin')

@section('content')
        <div class="row">
            <div class="col-md-12">

                <div class="panel-default panel">
                    <div class="panel-heading">

                        Edit Category
                        <!--<small>Sub title</small> -->

                    </div>
                    <div class="panel-body">

                         {!! Form::bind($orderStatus, ['method' => 'PUT', 
                                            'action' => route('admin.order-status.update', $orderStatus->id)
                                            ]) !!}
                        @include('admin.order-status._fields')
                    
                {!! Form::submit('Update Order Status') !!}
                    
                {!! Form::close() !!}
                    </div>
                </div>

            </div>
        </div>
@endsection