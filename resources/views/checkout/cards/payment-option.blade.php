
<div><h4 class="text-lg text-red-700 font-semibold my-5">{{ __('Payment Options') }}</h4></div>

@foreach ($paymentOptions as $payment)
    <p>
        {{ $payment->render() }}
    </p>
@endforeach
<input type="hidden" name="payment_option" v-model="paymentOption" />
