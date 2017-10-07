@extends('mage2-ecommerce::admin.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">


            <div class="card">
                <div class="card-header">
                    Order Configuration List
                </div>
                <div class="card-body">
                    {!! Form::bind($configurations, ['method' => 'post', 'action' => route('admin.configuration.store')]) !!}

                    {!! Form::select('mage2_order_default_first_status',
                                    'Default First Order Status(e.g: Pending)',
                                    $orderStatusOption) !!}

                    {!! Form::select('mage2_order_default_last_status',
                                    'Default Last Order Stauts(e.g: Received)',
                                    $orderStatusOption) !!}

                    {!! Form::submit('Save Configuration') !!}

                    {!! Form::close() !!}
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

