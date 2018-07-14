<div class="card mb-3">
    <div class="card-header">Payment Options</div>
    <div class="card-body payment-options">

        <p>Please select the preferred payment method to use on this
            order.</p>

        <div class="payment-radio-options">
            @foreach($paymentOptions as $paymentOption)

                @if(true === $paymentOption->enable())
                    <div class="payment-option-wrap mb-3">
                    <div class="form-check">
                        <input name="payment_option"
                                type="radio" name="payment_option[pickup]"
                                id="{{ $paymentOption->identifier() }}"
                                value="{{ $paymentOption->identifier() }}"
                                
                                @if($errors->has('payment_option'))
                                    class="is-invalid avored-payment-option form-check-input"
                                @else
                                    class="avored-payment-option form-check-input"
                                @endif
                           
                            >

                        <label for="{{ $paymentOption->identifier() }}"
                               class="form-check-label">
                            {!! $paymentOption->name() !!}
                        </label>

                        
                    </div>

                    <div class="card-view-if-any">
                        @include($paymentOption->view(), $paymentOption->with())
                    </div>

                    </div>
                @endif

            @endforeach
            @if ($errors->has('payment_option'))
                <div class="invalid-feedback" style="display:block">
                    {{ $errors->first('payment_option') }}
                </div>
            @endif
        </div>

       

    </div>
</div>


