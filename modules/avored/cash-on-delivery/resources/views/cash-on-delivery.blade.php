@push('scripts')

    <script>
        $(document).ready(function () {

            jQuery('#cash-on-delivery').bind('paymentProcessStart', function (e) {
                jQuery("#place-order-button").trigger('paymentProcessEnd');
            });
        });

    </script>
@endpush