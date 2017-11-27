@extends('layouts.app')

@section('meta_title','Checkout Page Mage2 E commerce')
@section('meta_description','Checkout Page Mage2 E commerce')


@section('content')
    <div class="container">
        <div class="h1">Checkout</div>

        @if(count($cartItems) <=  0)
            <p>Sorry No Product Found <a href="{{ route('home') }}">Start Shopping</a></p>
        @else

            <form id="place-order-form" method="post" action="{{ route('order.place') }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-6">

                        <div class="card">
                            <div class="card-header">
                                Your Personal Details
                            </div>
                            <div class="card-body">
                                <?php
                                $firstName = $lastName = $phone = "";
                                if (Auth::check()) {
                                    $firstName = Auth::user()->first_name;
                                    $lastName = Auth::user()->last_name;
                                    $phone = Auth::user()->phone;
                                }

                                ?>

                                <div class="row">
                                    <div class="form-group  col-6">
                                        <label class="control-label" for="input-user-first-name">First Name</label>
                                        <input type="text" name="billing[first_name]"
                                               value="{{ $firstName }}" placeholder="First Name"
                                               id="input-user-first-name"
                                               @if($errors->has('billing.first_name'))
                                                    class="is-invalid form-control"
                                               @else
                                                    class="form-control"
                                               @endif
                                        >
                                        @if ($errors->has('billing.first_name'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('billing.first_name') }}
                                            </div>
                                        @endif

                                    </div>

                                    <div class="form-group  col-6">
                                        <label class="control-label" for="input-user-last-name">Last Name</label>
                                        <input type="text" name="billing[last_name]"
                                               value="{{ $lastName }}" placeholder="Last Name"
                                               id="input-user-last-name"
                                               @if($errors->has('billing.last_name'))
                                               class="is-invalid form-control"
                                               @else
                                               class="form-control"
                                               @endif
                                               >
                                        @if ($errors->has('billing.last_name'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('billing.last_name') }}
                                            </div>
                                        @endif
                                    </div>

                                </div>
                                @if(!Auth::check())

                                    <div class="form-group">
                                        <label class="control-label" for="input-user-email">E-Mail</label>
                                        <input type="text"
                                                name="user[email]" placeholder="E-Mail"
                                                id="input-user-email"

                                                @if($errors->has('user.email'))
                                                    class="is-invalid form-control"
                                                @else
                                                    class="form-control"
                                                @endif
                                        >
                                        @if ($errors->has('user.email'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('user.email') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>
                                            <input type="checkbox" name="register"
                                                   onclick="if (this.checked == true) jQuery('.register-form').css('display','block');
                                                      else jQuery('.register-form').css('display','none');">
                                            &nbsp;Register Account
                                        </label>
                                    </div>


                                    <div class="register-form" style="display: none;">
                                        <div class="row">
                                            <div class="form-group  col-6">
                                                <label class="control-label"
                                                       for="input-billing-password">Password</label>
                                                <input type="text" name="user[password]" placeholder="Password"
                                                       id="input-billing-password" class="form-control">
                                            </div>
                                            <div class="form-group  col-6">
                                                <label class="control-label" for="input-billing-confirm">Password
                                                    Confirm</label>
                                                <input type="text" name="user[confirm_password]"
                                                       placeholder="Password Confirm"
                                                       id="input-billing-confirm" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                @endif

                                <div class="form-group">
                                    <label class="control-label" for="input-billing-phone">Phone</label>
                                    <input type="text" name="billing[phone]" value="{{ $phone }}" placeholder="Phone"
                                           id="input-billing-phone" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="card-header">Your Address</div>

                            <div class="card-body">

                                <div id="payment-address-new">


                                    <?php
                                    $address = NULL;
                                    if (NULL !== $user) {
                                        $address = $user->getBillingAddress();
                                    }
                                    ?>

                                    @if(NULL === $address)
                                        <div class="form-group">
                                            <label class="control-label" for="input-billing-address-1">Address 1</label>
                                            <input type="text" name="billing[address1]" value="" placeholder="Address 1"
                                                   id="input-billing-address-1" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label" for="input-billing-address-2">Address 2</label>
                                            <input type="text" name="billing[address2]" value="" placeholder="Address 2"
                                                   id="input-billing-address-2" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="country">Country</label>
                                            <select name="billing[country_id]" data-name="country_id"
                                                    class="billing-country form-control billing tax-calculation">
                                                @foreach($countries as $countryId => $countryName)
                                                    <option
                                                            value="{{ $countryId }}">{{ $countryName }}</option>
                                                @endforeach
                                            </select>

                                            @if ($errors->has('country'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('country') }}</strong>
                                            </span>
                                            @endif
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label class="control-label" for="input-billing-zone">Region /
                                                    State</label>
                                                <input type="text" name="billing[state]" data-name="state_code"
                                                       id="input-billing-zone"
                                                       class="billing tax-calculation form-control"/>
                                            </div>


                                            <div class="form-group  col-6">
                                                <label class="control-label" for="input-billing-city">City</label>
                                                <input type="text" data-name="city" name="billing[city]"
                                                       placeholder="City"
                                                       id="input-billing-city"
                                                       class="billing tax-calculation form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="input-billing-postcode">Post Code</label>
                                            <input type="text" data-name="postcode" name="billing[postcode]" value=""
                                                   placeholder="Post Code"
                                                   id="input-billing-postcode"
                                                   class="billing tax-calculation form-control">
                                        </div>

                                    @else

                                        <div class="form-group  col-12">
                                            <div class="card card-default">
                                                <div class="card-header">Billing Address</div>
                                                <div class="card-body">

                                                    <p>
                                                        {{ $address->first_name }} {{ $address->last_name }}
                                                        <br/>
                                                        {{ $address->address1 }}<br/>
                                                        {{ $address->address2 }}<br/>
                                                        {{ $address->area }}<br/>
                                                        {{ $address->city }}<br/>
                                                        {{ $address->state }} {{ $address->country->name }}<br/>
                                                        {{ $address->phone }}<br/>
                                                    </p>
                                                    <input type="hidden" name="billing[id]" value="{{ $address->id }}"/>
                                                </div>
                                            </div>
                                        </div>

                                    @endif


                                    <div class="form-group col-12">
                                        <label>
                                            <input type="checkbox" name="use_different_shipping_address"
                                                   onclick="if (this.checked == true){
                                                            jQuery('.different-shipping-form').css('display','block');
                                                            } else  { jQuery('.different-shipping-form').css('display','none'); }
                                                        ">&nbsp;Use Different Address for Shipping
                                            Account</label>
                                    </div>

                                </div>


                                <div class="different-shipping-form" style="display:none">


                                    <div class="row">
                                        <div class="form-group  col-6">
                                            <label class="control-label" for="input-billing-firstname">First
                                                Name</label>
                                            <input type="text" name="shipping[first_name]"
                                                   value="" placeholder="First Name"
                                                   id="input-billing-firstname" class="form-control">
                                        </div>
                                        <div class="form-group  col-6">
                                            <label class="control-label" for="input-billing-lastname">Last Name</label>
                                            <input type="text" name="shipping[last_name]"
                                                   value="" placeholder="Last Name"
                                                   id="input-billing-lastname" class="form-control">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="control-label" for="input-billing-address-1">Address 1</label>
                                        <input type="text" name="shipping[address1]" value="" placeholder="Address 1"
                                               id="input-billing-address-1" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label" for="input-billing-address-2">Address 2</label>
                                        <input type="text" name="shipping[address2]" value="" placeholder="Address 2"
                                               id="input-billing-address-2" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="country">Country</label>
                                        <select name="shipping[country_id]" data-name="country_id"
                                                class="shipping tax-calculation form-control">
                                            @foreach($countries as $countryId => $countryName)
                                                <option
                                                        value="{{ $countryId }}">{{ $countryName }}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('country'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('country') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label class="control-label" for="input-billing-zone">Region / State</label>
                                            <input type="text" data-name="state_code" name="shipping[state]"
                                                   id="input-billing-zone"
                                                   class="shipping tax-calculation form-control"/>
                                        </div>


                                        <div class="form-group  col-6">
                                            <label class="control-label" for="input-billing-city">City</label>
                                            <input type="text" data-name="city" name="shipping[city]" placeholder="City"
                                                   id="input-billing-city"
                                                   class="shipping tax-calculation  form-control">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label class="control-label" for="input-billing-postcode">Post Code</label>
                                            <input type="text" data-name="postcode" name="shipping[postcode]" value=""
                                                   placeholder="Post Code"
                                                   id="input-billing-postcode"
                                                   class="shipping tax-calculation  form-control">
                                        </div>

                                        <div class="form-group   col-6">
                                            <label class="control-label" for="input-billing-phone">Phone</label>
                                            <input type="text" name="shipping[phone]" value="" placeholder="Phone"
                                                   id="input-billing-phone" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-6">

                        <div class="card mb-3">
                            <div class="card-header">
                                Shipping Option
                            </div>
                            <div class="card-body shipping-method">
                                <p>Please select the preferred shipping method to use on this order.</p>

                                @foreach($shippingOptions as $shippingOption)
                                    <div class="input-group {{ $errors->has('shipping_option') ? ' has-error' : '' }}">

                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="shipping_option"
                                                       class="shipping_option_radio"
                                                       data-title="{{ $shippingOption->getTitle() }}"
                                                       data-cost="{{ number_format($shippingOption->getAmount(),2) }}"
                                                       id="{{ $shippingOption->getIdentifier() }}"
                                                       value="{{ $shippingOption->getIdentifier() }}">
                                                {{ $shippingOption->getTitle() . " " . number_format($shippingOption->getAmount(),2) }}

                                            </label>

                                            @if ($errors->has('shipping_option'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('shipping_option') }}</strong>
                                                </span>
                                            @endif
                                        </div>


                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">Payment Options</div>
                            <div class="card-body payment-method">

                                <p>Please select the preferred payment method to use on this
                                    order.</p>

                                @foreach($paymentOptions as $paymentOption)


                                    @if(true === $paymentOption->isEnabled())

                                        <div class="form-group {{ $errors->has('payment_option') ? ' has-error' : '' }}">


                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input class="form-check-input"
                                                           type="radio" name="payment_option"
                                                           id="payment_option"
                                                           value="{{ $paymentOption->getIdentifier() }}">
                                                    {!! $paymentOption->getTitle() !!}
                                                </label>
                                            </div>


                                            @if ($errors->has('payment_option'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('payment_option') }}</strong>
                                        </span>
                                            @endif
                                        </div>

                                    @endif

                                @endforeach
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">Shopping Cart</div>
                            <div class="card-body">
                                <table id="cart_table" class="table table-bordered table-hover table-responsive">
                                    <thead>
                                    <tr>
                                        <th class="text-left">Product Name</th>
                                        <th class="text-right hidden-xs">Quantity</th>
                                        <th class="text-right hidden-xs">Unit Price</th>
                                        <th class="text-right">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $subTotal = 0;$totalTax = 0; ?>
                                    @foreach($cartItems as $cartItem)
                                        <tr>
                                            <td class="text-left">
                                                {{ $cartItem['name'] }}

                                                <br>
                                                &nbsp;
                                                <?php $attributeText = ""; ?>
                                                @if(isset($cartItem['attributes']) && count($cartItem['attributes']) > 0)
                                                    @foreach($cartItem['attributes'] as $attribute)
                                                        @if($loop->last)
                                                            <?php $attributeText .= $attribute['variation_display_text']; ?>
                                                        @else
                                                            <?php $attributeText .= $attribute['variation_display_text'] . ": "; ?>
                                                        @endif
                                                    @endforeach


                                                    <p>Attributes: <span
                                                                class="text-success"><strong>{{ $attributeText}}</strong></span>
                                                    </p>
                                                @endif

                                            </td>

                                            <td class="text-right hidden-xs">{{ $cartItem['qty'] }}</td>
                                            <td class="text-right hidden-xs">
                                                ${{ number_format($cartItem['final_price'],2) }}</td>
                                            <td class="text-right">
                                                ${{ number_format($cartItem['qty'] * $cartItem['final_price'], 2) }}</td>
                                        </tr>

                                        <?php $totalTax += $cartItem['qty'] * $cartItem['tax_amount']  ?>
                                        <?php $subTotal += $cartItem['qty'] * $cartItem['final_price']  ?>
                                        <input type="hidden" name="products[]" value="{{ $cartItem['id'] }}"/>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-right  hidden-xs"><strong>Sub-Total:</strong></td>
                                        <td class="text-right sub-total" data-sub-total="{{ $subTotal }}">
                                            ${{ number_format($subTotal ,2)}}</td>
                                    </tr>
                                    <tr class="hidden shipping-row">
                                        <td colspan="3" class="text-right shipping-title  hidden-xs"
                                            style="font-weight: bold;">Shipping Option
                                        </td>
                                        <td class="text-right shipping-cost" data-shipping-cost="0.00">$</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-right  hidden-xs"><strong>Tax Amount:</strong></td>
                                        <td class="text-right tax-amount" data-tax-amount="{{ $totalTax }}">
                                            ${{ number_format($totalTax,2) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-right  hidden-xs"><strong>Total:</strong></td>
                                        <td class="text-right total" data-total="{{ $subTotal + $totalTax }}">
                                            ${{ number_format($subTotal + $totalTax,2) }}</td>
                                    </tr>
                                    </tfoot>

                                </table>
                            </div>
                        </div>


                        <div class="card mb-3">
                            <div class="card-header">
                                Your Comment
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <textarea name="comment" rows="3" class="form-control"></textarea>

                                    <div class="buttons clearfix">
                                        <div class="float-right">
                                            I have read and agree to the
                                            <a href="{{ $termConditionPageUrl }}" target="_blank" class="agree"><b>Terms
                                                    &amp;
                                                    Conditions</b></a>
                                            <input type="checkbox" name="agree" value="1"/>
                                            &nbsp;
                                        </div>
                                    </div>

                                    <div class="payment float-right clearfix">
                                        <input type="button" class="btn btn-primary"
                                               data-loading-text="Loading..." id="place-order-button"
                                               onclick="javascript=''"
                                               value="PlaceOrder">


                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </form>

        @endif
    </div>
@endsection

@push('scripts')
    <script>

        $(function () {

            function calcualateTotal() {
                subTotal = parseFloat(jQuery('.sub-total').attr('data-sub-total')).toFixed(2);
                shippingCost = parseFloat(jQuery('.shipping-cost').attr('data-shipping-cost')).toFixed(2);
                taxAmount = parseFloat(jQuery('.tax-amount').attr('data-tax-amount')).toFixed(2);

                total = parseFloat(subTotal) + parseFloat(taxAmount) + parseFloat(shippingCost);
                jQuery('.total').attr('data-total', total.toFixed(2));
                jQuery('.total').html("$" + total.toFixed(2));


            }


            function checkIfUserExist(data) {
                $.post({
                    url: "/check-user-exists",
                    data: data,
                    type: 'json',
                    success: function (res) {
                        console.info(res);
                    }
                });
            }

            jQuery(document).on('change', '#input-user-email', function (e) {
                var data = {
                    'email': jQuery(this).val(),
                    '_token': '{{ csrf_token()  }}'
                };

                checkIfUserExist(data);

            });

            /**
             jQu`ry('.tax-calculation').change(function () {
            var data = {
                'name': jQuery(this).attr('data-name'),
                'value': jQuery(this).val(),
                '_token': '{{ csrf_token()  }}'
            };

            $.post({
                data: data,
                type: 'json',
                url: '{{ route("tax.calculation") }}',
                success: function (res) {
                    if ((res.success == true)) {
                        jQuery('.tax-amount').html(res.tax_amount_text);
                        jQuery('.tax-amount').attr('data-tax-amount', res.tax_amount);
                        calcualateTotal();
                    }
                }
            });
        });
             */
            jQuery('.shipping_option_radio').change(function (e) {

                if (jQuery(this).is(':checked')) {
                    var shippingTitle = jQuery(this).attr('data-title');
                    var shippingCost = jQuery(this).attr('data-cost');

                    jQuery('.shipping-row').removeClass('hidden');

                    jQuery('.shipping-row .shipping-title').html(shippingTitle + ":");
                    jQuery('.shipping-row .shipping-cost').html("$" + shippingCost);
                    jQuery('.shipping-row .shipping-cost').attr('data-shipping-cost', shippingCost);


                } else {
                    jQuery('.shipping-row').addClass('hidden');
                }
                calcualateTotal();
            });

            jQuery('#place-order-button').click(function (e) {
                jQuery('#place-order-form').submit();
            });
        });
    </script>
@endpush