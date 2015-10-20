@extends('mage2::front.master')


@section('content')

 {!! Form::open(array( 'url' => url('order'))) !!}
<ul class="list-group">
    @foreach($config['shipping'] as $shippingIdentifier => $shipping)
    <li class="list-group-item">
        <input type="radio" value="{{ $shippingIdentifier }}" name="shipping_type"/> 
        <label>{{ $shipping['label'] }}</label>
    </li>
    @endforeach
    
    {!! Form::button('continue',['class'=>'btn btn-primary','onclick' => 'jQuery(this).parents("form:first").submit()']) !!}
    {!! Form::hidden('order_id',$order->id) !!}
    {!! Form::hidden('step','shipping-method') !!}
    {!! Form::close() !!}

</ul>

@endsection