<div class="card mb-3">
    <div class="card-header">
        Shipping Option
    </div>
    <div class="card-body shipping-option">
        <p>Please select the preferred shipping method to use on this order.</p>

        @foreach($shippingOptions as $shippingOption)


                <div class="form-check">

                    @if($shippingOption->enable())
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

                        @if(null === $shippingOption->amount())
                            {{ $shippingOption->name() }}
                        @else
                            {{ $shippingOption->name() . " $" . number_format($shippingOption->amount(),2) }}
                        @endif




                    </label>
                    @endif
                    @if ($errors->has('shipping_option'))
                        <div class="invalid-feedback" style="display: block">
                            {{ $errors->first('shipping_option') }}
                        </div>
                    @endif

                </div>

        @endforeach

        @foreach($shippingOptions as $shippingOption)
            @if($shippingOption->enable())
                @include($shippingOption->view(), $shippingOption->with())
            @endif
        @endforeach


    </div>
</div>