@php
    $value = $repository->getValueByCode('a_pickup_status');

    $options = collect();
    $options->put('ENABLED', 'Enabled');
    $options->put('DISABLED', 'Disabled');
   
@endphp

<avored-select
    field-name="a_pickup_status"
    label-text="{{ __('avored-pickup::pickup.status-field') }}"
    :options="{{ json_encode($options) }}"
    init-value="{{ $value }}"
></avored-select>
