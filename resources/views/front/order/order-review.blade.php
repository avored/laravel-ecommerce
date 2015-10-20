@extends('mage2::front.master')


@section('content')
    <h1>Checkout</h1>

    {!! Form::model($data,array( 'url' => url('order'))) !!}

    <div class="col-md-12">

        <?php $total = 0 ?>
        @foreach($cart as $item)


            <?php $total += $item['qty'] * $item['price']->first()->sale_price; ?>
            <div class="row">

                <div class="col-xs-3">
                    <img class="img-responsive" width="100" src="{!! url($item['image']) !!}">
                </div>
                <div class="col-xs-4">
                    <h4 class="product-name"><strong>{!! $item['name'] !!}</strong></h4>
                </div>
                <div class="col-xs-4">
                    <div class="text-right">
                        <h6><strong>{!! $item['price']->first()->sale_price !!} <span
                                        class="text-muted">x</span></strong> {{ $item['qty']  }}</h6>
                    </div>
                </div>
            </div>
        @endforeach

        <hr/>
        <div class="form-group">
            {!!  Form::button('Place Order',array(	'onclick' => 'jQuery(this).parents("form:first").submit()',
            'class' => 'btn btn-primary' ))  !!}
        </div>
    </div>

    {!! Form::hidden('order_id',$order->id) !!}
    {!! Form::hidden('step','order-review') !!}
    {!! Form::close() !!}

@endsection