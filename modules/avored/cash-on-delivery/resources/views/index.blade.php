<a-switch @change="handlePaymentChange($event, '{{ $payment->identifier() }}')">
</a-switch>
{{ $payment->name() }}
