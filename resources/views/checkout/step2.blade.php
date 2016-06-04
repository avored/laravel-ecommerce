@extends('layouts.front.app')

@section('content')

<div class="row">
    <div class="col s12">
        <h1>Checkout</h1>
        <div class="col offset-s3 s6" >
            <form action="/checkout/step3" method="post">
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">Billing Info</span>
                        <div class="row">
                            <div class="input-field col s6">
                                <input type="text" name="billing[first_name]" id="shipping_first_name" value="">
                                <label for="shipping_first_name" class="">First Name 
                                    <abbr class="required" title="required">*</abbr></label>
                            </div>
                            <div class="input-field col s6">
                                <input type="text" name="billing[last_name]" id="shipping_last_name" value="">
                                <label for="shipping_last_name" class="">Last Name 
                                    <abbr class="required" title="required">*</abbr>
                                </label>
                            </div>
                        </div>
                        <div class="input-field">
                            <input type="text" name="billing[company_name]" id="shipping_company_name" value="">
                            <label for="shipping_company_name" class="">Company Name</label>
                        </div>
                        <div class="input-field">
                            <input type="text" name="email" id="customer_email" value="">
                            <label for="customer_email" class="">Email
                                <abbr class="required" title="required">*</abbr>
                            </label>
                        </div>
                        @if($orderData['checkout_type'] == "customer")
                        <div class="input-field password_field">
                            <input type="text" name="password" id="customer_password" value="">
                            <label for="customer_password" class="">Password
                                <abbr class="required" title="required">*</abbr>
                            </label>
                        </div>
                        @endif
                        <div class="input-field">
                            <select name="shipping[country]" >
                                <option value="1">New Zealand</option>
                            </select>
                            <label for="shipping_phone" class="">Country <abbr class="required" title="required">*</abbr></label>
                        </div>
                        <div class="input-field">
                            <input type="text" name="billing[address_1]" id="shipping_address_1" value="">
                            <label for="shipping_address_1" class="">Address Line 1
                                <abbr class="required" title="required">*</abbr>
                            </label>
                        </div>
                        <div class="input-field">
                            <input type="text" name="billing[address_2]" id="shipping_address_2" value="">
                            <label for="shipping_address_2" class="">Address Line 2
                            </label>
                        </div>
                        <div class="input-field">
                            <input type="text" name="billing[city]" id="shipping_city" value="">
                            <label for="shipping_city" class="">City
                                <abbr class="required" title="required">*</abbr>
                            </label>
                        </div>
                        <div class="input-field">
                            <input type="text" name="billing[state]" id="shipping_state" value="">
                            <label for="shipping_state" class="">State
                            </label>
                        </div>
                        <div class="input-field">
                            <input type="text" name="billing[postcode]" id="shipping_postcode" value="">
                            <label for="shipping_postcode" class="">Post Code
                                <abbr class="required" title="required">*</abbr>
                            </label>
                        </div>
                        <div class="input-field">
                            <input type="text" name="billing[phone]" id="shipping_phone" value="">
                            <label for="shipping_phone" class="">Phone 
                                <abbr class="required" title="required">*</abbr>
                            </label>
                        </div>
                        <div class="input-field">
                            <input id="use_same_shipping_checkbox" onclick="jQuery('.shipping-fields').slideToggle('slow');" checked="true" type="checkbox" value="1" name="use_same_for_shipping" />
                            <label for="use_same_shipping_checkbox">Use Same for Shipping</label>
                        </div>
                        <div class="right">
                            <button type="submit">Continue</button>
                        </div>
                        <br/>
                    </div> <!-- END OF BILLING CARD CONTENT -->
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
