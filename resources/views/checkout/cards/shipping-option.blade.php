
<div><h4 class="text-lg text-red-700 font-semibold my-5">{{ __('Shipping Options') }}</h4></div>


@foreach ($shippingOptions as $shipping)
    <avored-toggle
        label-text="{{ $shipping->name() }}"
        error-text="{{ $errors->first('shipping_option') }}"
        field-name="shipping_option"
    ></avored-toggle>    
@endforeach
