
<a-divider><h4 class="mt-1">{{ __('Payment Options') }}</h4></a-divider>

@foreach ($paymentOptions as $payment)
    <a-switch @change="handlePaymentChange($event, '{{ $payment->identifier() }}')"></a-switch>
    {{ $payment->name() }}
@endforeach
<input type="hidden" name="payment_option" v-model="paymentOption" />
