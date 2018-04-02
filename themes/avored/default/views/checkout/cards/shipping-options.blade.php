<div class="card mb-3">
    <div class="card-header">
        Shipping Option
    </div>
    <div class="card-body shipping-method">
        <p>Please select the preferred shipping method to use on this order.</p>

        @foreach($shippingOptions as $shippingOption)
            <div class="form-check {{ $errors->has('shipping_option') ? ' is-invalid' : '' }}">

                <input type="radio" name="shipping_option"

                       @if($errors->has('shipping_option'))
                       class="is-invalid form-check-input shipping_option_radio"
                       @else
                       class="shipping_option_radio form-check-input"
                       @endif

                       data-title="{{ $shippingOption->name() }}"
                       data-cost="{{ number_format($shippingOption->amount(),2) }}"
                       id="{{ $shippingOption->identifier() }}"
                       value="{{ $shippingOption->identifier() }}">

                <label for="{{ $shippingOption->identifier() }}" class="form-check-label">

                    {{ $shippingOption->name() . " " . number_format($shippingOption->amount(),2) }}


                </label>

                @if ($errors->has('shipping_option'))
                    <div class="invalid-feedback">
                        {{ $errors->first('shipping_option') }}
                    </div>
                @endif

            </div>
        @endforeach
    </div>
</div>