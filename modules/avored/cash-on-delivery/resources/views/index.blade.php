<avored-cash-on-delivery inline-template>
    <avored-toggle
            label-text="Cash On Delivery"
            field-name="payment_option"
            error-text="{{ $errors->first('payment_option') }}"
            toggle-on-value="a-cash-on-delivery"
        ></avored-toggle>
</avored-cash-on-delivery>
@push('scripts')
    <script src="{{ asset('vendor/avored/js/cash-on-delivery.js') }}"></script>
@endpush
