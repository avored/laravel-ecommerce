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

                <div id="paypal-button-container"></div>
                <script src="https://www.paypalobjects.com/api/checkout.js"></script>

                <script>
                    paypal.Button.render({

                        env: 'sandbox', // sandbox | production

                        // PayPal Client IDs - replace with your own
                        // Create a PayPal app: https://developer.paypal.com/developer/applications/create
                        client: {
                            sandbox:    'AZDxjDScFpQtjWTOUtWKbyN_bDt4OgqaF4eYXlewfBP4-8aqX3PiV8e1GWU6liB2CUXlkA59kJXE7M6R',
                            production: '<insert production client id>'
                        },

                        // Show the buyer a 'Pay Now' button in the checkout flow
                        commit: true,

                        // payment() is called when the button is clicked
                        payment: function(data, actions) {

                            // Make a call to the REST api to create the payment
                            return actions.payment.create({
                                payment: {
                                    transactions: [
                                        {
                                            amount: { total: '0.01', currency: 'USD' }
                                        }
                                    ]
                                }
                            });
                        },

                        // onAuthorize() is called when the buyer approves the payment
                        onAuthorize: function(data, actions) {

                            // Make a call to the REST api to execute the payment
                            return actions.payment.execute().then(function() {
                                window.alert('Payment Complete!');
                            });
                        }

                    }, '#paypal-button-container');

                </script>
        </div>


        @foreach($paymentOptions as $paymentOption)

            @if($paymentOption->enable())
                @include($paymentOption->view(), $paymentOption->with())
            @endif

        @endforeach
    </div>
</div>


