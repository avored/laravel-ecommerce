@php
    $data = collect();
    $data->put('a_cash_on_delivery_status', $repository->getValueByCode('a_cash_on_delivery_status'))
@endphp

<cash-on-delivery-config :data="{{ $data }}"></cash-on-delivery-config>

@push('scripts')
<script src="{{ asset('avored-admin/js/cash-on-delivery.js') }}"></script>
@endpush
