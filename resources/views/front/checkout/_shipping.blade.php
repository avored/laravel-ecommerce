<?php //var_dump($config['shipping']); ?>
<ul class="list-group">
    @foreach($config['shipping'] as $shippingIdentifier => $shipping)
    <li class="list-group-item">
        <input type="radio" value="{{ $shippingIdentifier }}" name="shipping_type"/> <label>{{ $shipping['label'] }}</label>
    </li>
    @endforeach

</ul>