@extends('layouts.my-account')

@section('meta_title','My Account E commerce')
@section('meta_description','My Account E commerce')

@section('account-content')
<h3>{{  __('return.title') }}</h3>
<div class="col-md-12">
    <p>{{ __('return.intro') }}</p>
    <div class="clearfix">&nbsp;</div>

    <div class="table-responsive-sm">
        <form action="{{ route('my-account.order.return.post', $order->id) }}" method="post">
            @csrf()

            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th class="text-center">{{ __('return.product') }}</th>
                        <th class="text-center">{{ __('return.quantity') }}</th>
                        <th class="col-md-2 text-center">{{ __('return.price') }}</th>
                        <th class="col-md-4 text-center">{{ __('return.reason') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->products as $product)
                        <tr>
                            <td> 
                                <div class="form-check">
                                    <input type="checkbox" name="products[{{ $product->slug }}][slug]" value="{{ $product->slug }}" id="order-product-{{ $product->slug }}" class="form-check-input="">
                                </div>
                            </td>
                            <td class="text-center">{{ $product->name }}
                                @foreach($order->orderProductVariation as $orderProductVariation)
                                <p>
                                    {{ $orderProductVariation->attribute->name }}
                                    :
                                    {{ $orderProductVariation->attributeDropdownOption->display_text }}
                                </p> 
                                @endforeach
                            </td>
                            <td class="text-center">
                                <div class="form-group">
                                    <select name="products[{{ $product->slug }}][qty]" class="form-control" required="">
                                        <option value="">{{ __('return.select') }}</option>
                                        @for($i = 0; $i<$product->getRelationValue('pivot')->qty; $i++)
                                            <option value="{{ $i+1 }}">{{ $i+1 }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </td>
                            <td class="text-center"> {{ $product->getRelationValue('pivot')->price }} </td>
                            <td class="text-center"> 
                                <select class="form-control product-reason-dropdown" name="products[{{ $product->slug }}][reason]" required="">
                                    <option value="">{{ __('return.select') }}</option>
                                    <option value="{{ __('return.option-broken') }}">{{ __('return.option-broken') }}</option>
                                    <option value="{{ __('return.option-never-delivered') }}">{{ __('return.option-never-delivered') }}</option>
                                    <option value={{ __('return.option-other') }}>{{ __('return.option-other') }}</option>
                                </select>
                                
                                <div class="form-group other-reason d-none">
                                    <label>{{ __('return.other_reason') }}</label>
                                    <textarea name="comment" class="form-control"></textarea>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="form-group">
                <label for="comment">{{ __('return.comment') }}</label>
                <textarea id="comment" name="comment" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">{{ __('return.submit') }}</button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    jQuery(document).ready(function() {
        jQuery(document).on('change','.product-reason-dropdown', function(e){
            if(jQuery(this).val() == 'Other') {
                jQuery(this).parent().find('.other-reason').removeClass('d-none');
            } else {
                jQuery(this).parent().find('.other-reason').addClass('d-none');
            }
        });
    });
</script>
@endpush