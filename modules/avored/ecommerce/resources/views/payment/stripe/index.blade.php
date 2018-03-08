<div id="stripe-card-form-wrapper" class="mt-3 d-none">


    <div class="col-md-12">
        <label for="card-element">
            Credit or debit card
        </label>
        <div id="card-element">
            <!-- A Stripe Element will be inserted here. -->
        </div>

        <!-- Used to display form errors. -->
        <div id="card-errors" role="alert"></div>
    </div>


</div>


<style>
    .StripeElement {
        background-color: white;
        height: 40px;
        padding: 10px 12px;
        border-radius: 4px;
        border: 1px solid transparent;
        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }

    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }

    .StripeElement--invalid {
        border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }
</style>

@push('scripts')

    <script src="https://js.stripe.com/v3/"></script>

    <script>
        $(document).ready(function () {

            var stripe = Stripe('{{ $token }}');
            var elements = stripe.elements();


            var style = {
                base: {
                    color: '#32325d',
                    lineHeight: '18px',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            };

            var card = elements.create('card', {style: style});
            card.mount('#card-element');


            jQuery('.avored-payment-option').change(function (e) {

                if (jQuery(this).prop('id') != "stripe") {

                    jQuery('#stripe-card-form-wrapper').addClass('d-none');
                    return;
                }

                if (jQuery(e.target).is(":checked")) {
                    jQuery('#stripe-card-form-wrapper').removeClass('d-none');
                }


            });

            jQuery('#stripe').bind('paymentProcessStart', function (e) {

                stripe.createToken(card).then(function (result) {
                    if (result.error) {
                        // Inform the customer that there was an error.
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                        jQuery("#place-order-button").prop('disabled', false);


                    } else {
                        // Send the token to your server.
                        stripeTokenHandler(result.token);
                        jQuery("#place-order-button").trigger('paymentProcessEnd');
                    }


                });
            });
        });

        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var formWrapper = document.getElementById('stripe-card-form-wrapper');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            formWrapper.appendChild(hiddenInput);
        }

    </script>
@endpush