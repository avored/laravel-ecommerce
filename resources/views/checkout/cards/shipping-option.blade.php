
<div>
    <h4 class="text-lg text-red-700 font-semibold my-5">
        {{ __('avored.shipping_options') }}
    </h4>
</div>


@foreach ($shippingOptions as $shipping)
    <avored-toggle
        label-text="{{ $shipping->name() }}"
        error-text="{{ $errors->first('shipping_option') }}"
        field-name="shipping_option"
        toggle-on-value="{{ $shipping->identifier() }}"
    ></avored-toggle>    
@endforeach
