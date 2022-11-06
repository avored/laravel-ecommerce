@php
    $data = collect();
    $data->put('a_cash_on_delivery_status', $repository->getValueByCode('a_cash_on_delivery_status'));

    $options = collect();
    $options->put('ENABLED', 'Enabled');
    $options->put('DISABLED', 'Disabled');
@endphp

<cash-on-delivery-config
    :options="{{ json_encode($options) }}"
    :data="{{ $data }}"
></cash-on-delivery-config>

@push('scripts')
<script src="{{ asset('vendor/avored/js/cash-on-delivery.js') }}"></script>
@endpush
