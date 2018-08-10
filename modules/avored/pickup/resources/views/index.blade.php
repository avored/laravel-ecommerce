@push('scripts')

    <script>
        $(document).ready(function () {

            jQuery('#pickup').bind('paymentProcessStart', function (e) {
                jQuery("#place-order-button").trigger('paymentProcessEnd');
            });
        });

    </script>
@endpush