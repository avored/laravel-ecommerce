@extends('layouts.app')

@section('content')



    <div class="container">

        <h1>Checkout</h1>

        <form id="place-order-form" method="post" action="{{ route('order.place') }}">
            {{ csrf_field() }}
            <div class="row box checkout_form">
                <div class="col-md-6 register_block">
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Your Personal Details</h3>
                        </div>

                        <div class="form-group  col-md-6">
                            <label class="control-label" for="input-billing-firstname">First Name</label>
                            <input type="text" name="billing[first_name]"
                                   value="" placeholder="First Name"
                                   id="input-billing-firstname" class="form-control">
                        </div>
                        <div class="form-group  col-md-6">
                            <label class="control-label" for="input-billing-lastname">Last Name</label>
                            <input type="text" name="billing[last_name]"
                                   value="" placeholder="Last Name"
                                   id="input-billing-lastname" class="form-control">
                        </div>

                        @if(!Auth::check())

                            <div class="form-group  col-md-12">
                                <label class="control-label" for="input-billing-email">E-Mail</label>
                                <input type="text" name="user[email]" placeholder="E-Mail" id="input-billing-email"
                                       class="form-control">
                            </div>

                            <div class="form-group col-md-12">
                                <label>
                                    <input type="checkbox" name="register"
                                           onclick="if (this.checked == true) jQuery('.register-form').slideDown('slow'); else jQuery('.register-form').slideUp('slow');">&nbsp;Register
                                    Account</label>
                            </div>


                            <div class="register-form" style="display: none;">
                                <div class="form-group  col-md-6">
                                    <label class="control-label" for="input-billing-password">Password</label>
                                    <input type="text" name="user[password]" placeholder="Password"
                                           id="input-billing-password" class="form-control">
                                </div>
                                <div class="form-group  col-md-6">
                                    <label class="control-label" for="input-billing-confirm">Password Confirm</label>
                                    <input type="text" name="user[confirm_password]" placeholder="Password Confirm"
                                           id="input-billing-confirm" class="form-control">
                                </div>
                            </div>

                        @endif

                        <div class="form-group   col-md-6">
                            <label class="control-label" for="input-billing-phone">Phone</label>
                            <input type="text" name="billing[phone]" value="" placeholder="Phone"
                                   id="input-billing-phone" class="form-control">
                        </div>

                        <div class="col-md-12">
                            <h3 class="clearfix">Your Address</h3>

                        </div>

                        <div id="payment-address-new">

                            <div class="form-group  col-md-12">
                                <label class="control-label" for="input-billing-address-1">Address 1</label>
                                <input type="text" name="billing[address1]" value="" placeholder="Address 1"
                                       id="input-billing-address-1" class="form-control">
                            </div>

                            <div class="form-group col-md-12">
                                <label class="control-label" for="input-billing-address-2">Address 2</label>
                                <input type="text" name="billing[address2]" value="" placeholder="Address 2"
                                       id="input-billing-address-2" class="form-control">
                            </div>

                            <div class="form-group  col-md-6">
                                <label for="country">Country</label>
                                <select name="billing[country_id]" data-name="country_id" class="billing-country form-control billing taxcalculation">
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

                            <div class="form-group col-md-6">
                                <label class="control-label" for="input-billing-zone">Region / State</label>
                                <input type="text" name="billing[state]" data-name="state" id="input-billing-zone" class="billing taxcalculation form-control"/>
                            </div>


                            <div class="form-group  col-md-6">
                                <label class="control-label" for="input-billing-city">City</label>
                                <input type="text" data-name="city" name="billing[city]" placeholder="City" id="input-billing-city"
                                       class="billing taxcalculation form-control">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="control-label" for="input-billing-postcode">Post Code</label>
                                <input type="text" data-name="postcode" name="billing[postcode]" value="" placeholder="Post Code"
                                       id="input-billing-postcode" class="billing taxcalculation form-control">
                            </div>


                            <div class="form-group col-md-12">
                                <label>
                                    <input type="checkbox" name="use_different_shipping_address"
                                           onclick="if (this.checked == true){
                                                        jQuery('.different-shipping-form').slideDown('slow');
                                                        } else  { jQuery('.different-shipping-form').slideUp('slow'); }
                                                    ">&nbsp;Use Different Address for Shipping
                                    Account</label>
                            </div>

                        </div>


                        <div class="different-shipping-form" style="display:none">


                            <div class="form-group  col-md-6">
                                <label class="control-label" for="input-billing-firstname">First Name</label>
                                <input type="text" name="shipping[first_name]"
                                       value="" placeholder="First Name"
                                       id="input-billing-firstname" class="form-control">
                            </div>
                            <div class="form-group  col-md-6">
                                <label class="control-label" for="input-billing-lastname">Last Name</label>
                                <input type="text" name="shipping[last_name]"
                                       value="" placeholder="Last Name"
                                       id="input-billing-lastname" class="form-control">
                            </div>

                            <div class="form-group  col-md-12">
                                <label class="control-label" for="input-billing-address-1">Address 1</label>
                                <input type="text" name="shipping[address1]" value="" placeholder="Address 1"
                                       id="input-billing-address-1" class="form-control">
                            </div>

                            <div class="form-group col-md-12">
                                <label class="control-label" for="input-billing-address-2">Address 2</label>
                                <input type="text" name="shipping[address2]" value="" placeholder="Address 2"
                                       id="input-billing-address-2" class="form-control">
                            </div>

                            <div class="form-group  col-md-6">
                                <label for="country">Country</label>
                                <select name="shipping[country_id]" data-name="country_id" class="shipping taxcalculation form-control">
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

                            <div class="form-group col-md-6">
                                <label class="control-label" for="input-billing-zone">Region / State</label>
                                <input type="text" data-name="state" name="shipping[state]" id="input-billing-zone" class="shipping axcalculation form-control"/>
                            </div>


                            <div class="form-group  col-md-6">
                                <label class="control-label" for="input-billing-city">City</label>
                                <input type="text" data-name="city" name="shipping[city]" placeholder="City" id="input-billing-city"
                                       class="shipping taxcalculation  form-control">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="control-label" for="input-billing-postcode">Post Code</label>
                                <input type="text" data-name="postcode" name="shipping[postcode]" value="" placeholder="Post Code"
                                       id="input-billing-postcode" class="shipping taxcalculation  form-control">
                            </div>

                            <div class="form-group   col-md-6">
                                <label class="control-label" for="input-billing-phone">Phone</label>
                                <input type="text" name="shipping[phone]" value="" placeholder="Phone"
                                       id="input-billing-phone" class="form-control">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <h3> Shipping Option</h3>
                    <div class="shipping-method">
                        <p>Please select the preferred shipping method to use on this order.</p>

                        @foreach($shippingOptions as $shippingOption)
                            <div class="input-group {{ $errors->has('shipping_option') ? ' has-error' : '' }}">
                                {!! Form::radio('shipping_option',$shippingOption->getTitle() . " " . $shippingOption->getAmount(),
                                                $shippingOption->getIdentifier(),
                                                ['class' =>'form-control','id' => $shippingOption->getIdentifier()]
                                                )
                                !!}

                                @if ($errors->has('shipping_option'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('shipping_option') }}</strong>
                                    </span>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <div class="your_order">
                        <h3>Shopping Cart</h3>
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
                                        {{ $cartItem['title'] }}

                                        <br>
                                        &nbsp;
                                        <small> - Select: Option here</small>
                                    </td>

                                    <td class="text-right hidden-xs">{{ $cartItem['qty'] }}</td>
                                    <td class="text-right hidden-xs">${{ number_format($cartItem['price'],2) }}</td>
                                    <td class="text-right">${{ $cartItem['qty'] * $cartItem['price'] }}</td>
                                </tr>

                                <?php $totalTax += $cartItem['qty'] * $cartItem['tax_amount']  ?>
                                <?php $subTotal += $cartItem['qty'] * $cartItem['price']  ?>
                                <input type="hidden" name="products[]" value="{{ $cartItem['id'] }}"/>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="3" class="text-right  hidden-xs"><strong>Sub-Total:</strong></td>
                                <td colspan="1" class="text-right  visible-xs"><strong>Sub-Total:</strong></td>
                                <td class="text-right">${{ $subTotal }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-right  hidden-xs"><strong>Flat Shipping Rate:</strong></td>
                                <td colspan="1" class="text-right  visible-xs"><strong>Flat Shipping Rate:</strong></td>
                                <td class="text-right">$5.00</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-right  hidden-xs"><strong>Tax Amount:</strong></td>
                                <td colspan="1" class="text-right  visible-xs"><strong>Tax Amount:</strong></td>
                                <td class="text-right">$5.00</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-right  hidden-xs"><strong>Total:</strong></td>
                                <td colspan="1" class="text-right  visible-xs"><strong>Total:</strong></td>
                                <td class="text-right">${{ $subTotal+5 }}</td>
                            </tr>
                            </tfoot>

                        </table>

                        <br>



                        <div class="payment-method">

                            <p>Please select the preferred payment method to use on this
                                order.</p>

                            @foreach($paymentOptions as $paymentOption)


                                @if(true === $paymentOption->isEnabled())

                                    <div class="form-group {{ $errors->has('payment_option') ? ' has-error' : '' }}">

                                        {!! Form::radio('payment_option',$paymentOption->getTitle(),$paymentOption->getIdentifier(),['id' => $paymentOption->getIdentifier()]) !!}


                                        @if ($errors->has('payment_option'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('payment_option') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                @endif

                            @endforeach
                        </div>

                        <p><strong>Add Comments About Your Order</strong></p>

                        <p>
                            <textarea name="comment" rows="3" class="form-control"></textarea>
                        </p>

                        <div class="buttons clearfix">
                            <div class="pull-right">
                                I have read and agree to the
                                <a href="#" class="agree"><b>Terms &amp; Conditions</b></a>
                                <input type="checkbox" name="agree" value="1" />
                                &nbsp;
                            </div>
                        </div>

                        <div class="payment pull-right clearfix">
                            <input type="button" class="btn btn-primary"
                                   data-loading-text="Loading..." id="place-order-button"
                                   onclick="javascript=''"
                                   value="PlaceOrder">
                            <script>

                                jQuery(document).ready(function () {

                                    jQuery('.taxcalculation').change(function(e){
                                        e.preventDefault();

                                        var data = { 'name' :  jQuery(this).attr('data-name'),
                                                    'value' : jQuery(this).val(),
                                                    '_token' : '{{ csrf_token()  }}'
                                                    };

                                        jQuery.ajax({
                                            data: data,
                                            url: '{{ route("tax.calculation") }}',
                                            method:"POST",
                                            success:function(res) {
                                                //console.info(res);
                                            }
                                        })



                                    });

                                    jQuery('#place-order-button').click(function (e) {
                                        jQuery('#place-order-form').submit();
                                    })
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
