
<div><h4 class="text-lg text-red-700 font-semibold my-5">{{ __('avored.payment_options') }}</h4></div>

@foreach ($paymentOptions as $payment)
    <p>
        {{ $payment->render() }}
    </p>
@endforeach
