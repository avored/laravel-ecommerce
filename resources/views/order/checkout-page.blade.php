@extends('layouts.front.app')

@section('content')

<div class="row">
    <div class="col s12">
        <h1>Checkout</h1>
        <form action="/checkout/place-order" method="post">

            <div class="col s6" >
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Checkout As</span>
                        <div class="clearfix"></div>
                        <div class="input-field">
                            <input type="radio" id="guest_customer_radio" onclick="jQuery('.password_field').toggle();" checked="true" name="checkout_type" value="customer" />
                            <label for="guest_customer_radio">Create Account</label>
                        </div>
                        <div class="input-field">
                            <input id="guest_checkout_radio" onclick="jQuery('.password_field').toggle();" type="radio" name="checkout_type" value="guess" />
                            <label for="guest_checkout_radio">Checkout as Guest</label>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Billing Info</span>
                        <div class="row">
                        <div class="input-field col s6">
                            <input type="text" name="shipping[first_name]" id="shipping_first_name" value="">
                            <label for="shipping_first_name" class="">First Name 
                                <abbr class="required" title="required">*</abbr></label>
                        </div>
                        <div class="input-field col s6">
                            <input type="text" name="shipping[last_name]" id="shipping_last_name" value="">
                            <label for="shipping_last_name" class="">Last Name 
                                <abbr class="required" title="required">*</abbr>
                            </label>
                        </div>
                        </div>
                        <div class="input-field">
                            <input type="text" name="shipping[company_name]" id="shipping_company_name" value="">
                            <label for="shipping_company_name" class="">Company Name</label>
                        </div>
                        <div class="input-field">
                            <input type="text" name="email" id="customer_email" value="">
                            <label for="customer_email" class="">Email
                                <abbr class="required" title="required">*</abbr>
                            </label>
                        </div>
                        <div class="input-field password_field">
                            <input type="text" name="password" id="customer_password" value="">
                            <label for="customer_password" class="">Password
                                <abbr class="required" title="required">*</abbr>
                            </label>
                        </div>
                        <div class="input-field">
                            <select name="shipping[country]" >
                                <option value="1">New Zealand</option>
                            </select>
                            <label for="shipping_phone" class="">Country <abbr class="required" title="required">*</abbr></label>
                        </div>
                        <div class="input-field">
                            <input type="text" name="shipping[address_1]" id="shipping_address_1" value="">
                            <label for="shipping_address_1" class="">Address Line 1
                                <abbr class="required" title="required">*</abbr>
                            </label>
                        </div>
                        <div class="input-field">
                            <input type="text" name="shipping[address_2]" id="shipping_address_2" value="">
                            <label for="shipping_address_2" class="">Address Line 2
                            </label>
                        </div>
                        <div class="input-field">
                            <input type="text" name="shipping[city]" id="shipping_city" value="">
                            <label for="shipping_city" class="">City
                                <abbr class="required" title="required">*</abbr>
                            </label>
                        </div>
                        <div class="input-field">
                            <input type="text" name="shipping[state]" id="shipping_state" value="">
                            <label for="shipping_state" class="">State
                            </label>
                        </div>
                        <div class="input-field">
                            <input type="text" name="shipping[postcode]" id="shipping_postcode" value="">
                            <label for="shipping_postcode" class="">Post Code
                                <abbr class="required" title="required">*</abbr>
                            </label>
                        </div>
                        <div class="input-field">
                            <input type="text" name="shipping[phone]" id="shipping_phone" value="">
                            <label for="shipping_phone" class="">Phone 
                                <abbr class="required" title="required">*</abbr>
                            </label>
                        </div>
                        <div class="input-field">
                            <input id="use_same_shipping_checkbox" onclick="jQuery('.shipping-fields').slideToggle('slow');" checked="true" type="checkbox" value="1" name="use_same_for_shipping" />
                            <label for="use_same_shipping_checkbox">Use Same for Shipping</label>
                        </div>
                        <br/>
                    </div> <!-- END OF BILLING CARD CONTENT -->
                </div>




                <div class="shipping-fields" style="display: none">
                    <h4>Billing Details</h4>
                    <div class="col s12">
                        <div class="input-field col s6">
                            <input type="text" name="billing[first_name]" id="billing_first_name" value="">
                            <label for="billing_first_name" class="">First Name 
                                <abbr class="required" title="required">*</abbr></label>
                        </div>
                        <div class="input-field col s6">
                            <input type="text" name="billing[last_name]" id="billing_last_name" value="">
                            <label for="billing_last_name" class="">Last Name 
                                <abbr class="required" title="required">*</abbr>
                            </label>
                        </div>
                    </div>
                    <div class="input-field col s12">
                        <input type="text" name="billing[company_name]" id="billing_company_name" value="">
                        <label for="billing_company_name" class="">Company Name</label>
                    </div>
                    <div class="input-field col s12">
                        <input type="text" name="billing[email]" id="billing_email" value="">
                        <label for="billing_email" class="">Email
                            <abbr class="required" title="required">*</abbr>
                        </label>
                    </div>

                    <div class="input-field col s12">
                        <input type="text" name="billing[phone]" id="billing_phone" value="">
                        <label for="billing_phone" class="">phone
                            <abbr class="required" title="required">*</abbr>
                        </label>
                    </div>

                    <div class="input-field col s12">
                        <select name="billing[country]" >
                            <option value="1">New Zealand</option>
                        </select>
                        <label for="billing_phone" class="">Country <abbr class="required" title="required">*</abbr></label>
                    </div>

                    <div class="input-field col s12">
                        <input type="text" name="billing[address_1]" id="billing_address_1" value="">
                        <label for="billing_address_1" class="">Address Line 1
                            <abbr class="required" title="required">*</abbr>
                        </label>
                    </div>
                    <div class="input-field col s12">
                        <input type="text" name="billing[address_2]" id="billing_address_2" value="">
                        <label for="billing_address_2" class="">Address Line 2
                        </label>
                    </div>
                    <div class="input-field col s12">
                        <input type="text" name="billing[city]" id="billing_city" value="">
                        <label for="billing_city" class="">City
                        </label>
                    </div>
                    <div class="input-field col s12">
                        <input type="text" name="billing[state]" id="billing_state" value="">
                        <label for="billing_state" class="">State
                        </label>
                    </div>
                    <div class="input-field col s12">
                        <input type="text" name="billing[postcode]" id="billing_postcode" value="">
                        <label for="billing_postcode" class="">postcode
                        </label>
                    </div>

                </div>


            </div>

            <div class="col s6">
                <div class="card">
                <div class="card-content">
                    <div class="row">
                        <h5>Shipping Option</h5>
                        <ul class="collection">
                            <li class="collection-item"><p>
                                    <input name="shipping_option" type="radio" value="free_shipping" id="shipping_1" />
                                    <label for="shipping_1">Free Shipping</label>
                                </p></li>
                            <li class="collection-item"><p>
                                    <input name="shipping_option" type="radio" value="fixed_rate" id="shipping_2" />
                                    <label for="shipping_2">Fixed Rate ($5.00)</label>
                                </p></li>
                        </ul>

                    </div> <!-- END OF SHIPPING ROW -->
                    
                    <div class="row">
                        <h5>Payment Option</h5>
                        <ul class="collection">
                            <li class="collection-item"><p>
                                    <input name="payment_option" value="internet_banking" type="radio" id="payment_1" />
                                    <label for="payment_1">Internet Banking</label>
                                </p></li>
                            <li class="collection-item"><p>
                                    <input name="payment_option" value="payment_by_cheque" type="radio" id="payment_2" />
                                    <label for="payment_2">Payment By Cheque</label>
                                </p></li>
                        </ul>

                    </div> <!-- END OF SHIPPING ROW -->

                    <div class=" input-group">
                        <div class="right">
                            <button type="submit" class="btn btn-primary btn-submit-fix">Place Order</button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div> <!-- END OF RIGHT CARD DIV CONTENT -->

            </div> <!-- END OF RIGHT CARD DIV -->
                
            </div>
    </div>


    {!! csrf_field() !!}
</form>

</div>
</div>
@endsection
