@extends('mage2::front.master')


@section('content')
 {!! Form::open(array( 'url' => url('order'))) !!}
 
 <?php //var_dump($config['shipping']); ?>
<ul class="list-group">
    @foreach($config['payment'] as $paymentIdentifier => $payment)
    <li class="list-group-item">
        <input type="radio" value="{{ $paymentIdentifier }}" name="payment_type"/> 
        <label>{{ $payment['label'] }}</label>
    </li>
    @endforeach

</ul>

    {!! Form::button('continue',['class'=>'btn btn-primary','onclick' => 'jQuery(this).parents("form:first").submit()']) !!}
    {!! Form::hidden('order_id',$order->id) !!}
    {!! Form::hidden('step','payment-method') !!}
    {!! Form::close() !!}

@endsection