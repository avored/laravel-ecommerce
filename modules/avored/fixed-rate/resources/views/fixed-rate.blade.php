
@if($shippingOption->enable())
<div class="form-check">

    <input type="radio" name="shipping_option"

        data-title="{{ $shippingOption->name() }}"
        data-cost="{{ number_format($shippingOption->amount(),2) }}"
        id="{{ $shippingOption->identifier() }}"
        value="{{ $shippingOption->identifier() }}"
        
        @if($errors->has('shipping_option'))
            class="is-invalid form-check-input shipping_option_radio"
        @else
            class="shipping_option_radio form-check-input"
        @endif

    />

    <label for="{{ $shippingOption->identifier() }}" class="form-check-label">
        @if(null === $shippingOption->amount())
            {{ $shippingOption->name() }}
        @else
            {{ $shippingOption->name() . " $" . number_format($shippingOption->amount(),2) }}
        @endif
    </label>
    @if ($errors->has('shipping_option'))
    <div class="invalid-feedback" style="display: block">
        {{ $errors->first('shipping_option') }}
    </div>
    @endif
    
</div>

@endif

@push('scripts')
    <script>
        $(document).ready(function () {


        });

    </script>
@endpush
