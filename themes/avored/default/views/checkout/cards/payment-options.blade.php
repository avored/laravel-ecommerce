<div class="card mb-3">
    <div class="card-header">Payment Options</div>
    <div class="card-body payment-options">

        <p>Please select the preferred payment method to use on this
            order.</p>

        <div class="payment-radio-options">
            @foreach($paymentOptions as $paymentOption)

                @if(true === $paymentOption->enable())

                    <div class="form-check">

                        <input class="avored-payment-option form-check-input {{ $errors->has('payment_option') ? ' is-invalid' : '' }}"
                               type="radio" name="payment_option"
                               id="{{ $paymentOption->identifier() }}"
                               value="{{ $paymentOption->identifier() }}">

                        <label for="{{ $paymentOption->identifier() }}"
                               class="form-check-label">
                            {!! $paymentOption->name() !!}
                        </label>

                        @if ($errors->has('payment_option'))
                            <div class="invalid-feedback">
                                {{ $errors->first('payment_option') }}
                            </div>
                        @endif
                    </div>

                @endif

            @endforeach
        </div>

        @foreach($paymentOptions as $paymentOption)
            @if($paymentOption->enable())
                @include($paymentOption->view(), $paymentOption->with())
            @endif
        @endforeach

    </div>
</div>


