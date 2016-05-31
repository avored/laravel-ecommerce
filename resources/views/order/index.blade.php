@extends('layouts.front.app')

@section('content')

<div class="row">
    <div class="col s12">
        <h1>Checkout</h1>
        <div class="col s12">
            <form action="/checkout/place-order" method="post">


                <div class="col s6" >
                    <div class="shipping-fields">
                        <h4>Shipping Details</h4>
                        <div class="col s12">
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
                        <div class="input-field col s12">
                            <input type="text" name="shipping[company_name]" id="shipping_company_name" value="">
                            <label for="shipping_company_name" class="">Company Name</label>
                        </div>
                        <div class="input-field col s12">
                            <input type="text" name="shipping[email]" id="shipping_email" value="">
                            <label for="shipping_email" class="">Email
                                <abbr class="required" title="required">*</abbr>
                            </label>
                        </div>

                        <div class="input-field col s12">
                            <input type="text" name="shipping[phone]" id="shipping_phone" value="">
                            <label for="shipping_phone" class="">phone
                                <abbr class="required" title="required">*</abbr>
                            </label>
                        </div>

                        <div class="input-field col s12">
                            <select name="shipping[country]" >
                                <option value="1">New Zealand</option>
                            </select>
                            <label for="shipping_phone" class="">Country <abbr class="required" title="required">*</abbr></label>
                        </div>

                        <div class="input-field col s12">
                            <input type="text" name="shipping[address_1]" id="shipping_address_1" value="">
                            <label for="shipping_address_1" class="">Address Line 1
                                <abbr class="required" title="required">*</abbr>
                            </label>
                        </div>
                        <div class="input-field col s12">
                            <input type="text" name="shipping[address_2]" id="shipping_address_2" value="">
                            <label for="shipping_address_2" class="">Address Line 2
                            </label>
                        </div>
                        <div class="input-field col s12">
                            <input type="text" name="shipping[city]" id="shipping_city" value="">
                            <label for="shipping_city" class="">City
                            </label>
                        </div>
                        <div class="input-field col s12">
                            <input type="text" name="shipping[state]" id="shipping_state" value="">
                            <label for="shipping_state" class="">State
                            </label>
                        </div>
                        <div class="input-field col s12">
                            <input type="text" name="shipping[postcode]" id="shipping_postcode" value="">
                            <label for="shipping_postcode" class="">postcode
                            </label>
                        </div>

                    </div>
                    <div class="billing-fields hide">
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
                    <h3 id="order_review_heading">Your order</h3>
                    <div id="order_review" class="woocommerce-checkout-review-order">
                        <table class="shop_table woocommerce-checkout-review-order-table">
                            <thead>
                                <tr>
                                    <th class="product-name">Product</th>
                                    <th class="product-total">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="cart_item">
                                    <td class="product-name">
                                        Happy Ninja&nbsp;							 <strong class="product-quantity">× 1</strong>													</td>
                                    <td class="product-total">
                                        <span class="amount">$35.00</span>						</td>
                                </tr>
                            </tbody>
                            <tfoot>

                                <tr class="cart-subtotal">
                                    <th>Subtotal</th>
                                    <td><span class="amount">$35.00</span></td>
                                </tr>




                                <tr class="shipping">
                                    <th>Shipping</th>
                                    <td data-title="Shipping">
                                        <p>There are no shipping methods available. Please double check your address, or contact us if you need any help.</p>


                                    </td>
                                </tr>






                                <tr class="order-total">
                                    <th>Total</th>
                                    <td><strong><span class="amount">$35.00</span></strong> </td>
                                </tr>


                            </tfoot>
                        </table>



                        <div id="payment" class="woocommerce-checkout-payment">
                            <ul class="wc_payment_methods payment_methods methods">
                                <li class="wc_payment_method payment_method_cheque">
                                    <input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="cheque" checked="checked" data-order_button_text="">

                                    <label for="payment_method_cheque">
                                        Cheque Payment 	</label>
                                    <div class="payment_box payment_method_cheque">
                                        <p>Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                    </div>
                                </li>
                                <li class="wc_payment_method payment_method_paypal">
                                    <input id="payment_method_paypal" type="radio" class="input-radio" name="payment_method" value="paypal" data-order_button_text="Proceed to PayPal">

                                    <label for="payment_method_paypal">
                                        PayPal <img src="https://www.paypalobjects.com/webstatic/mktg/Logo/AM_mc_vs_ms_ae_UK.png" alt="PayPal Acceptance Mark"><a href="https://www.paypal.com/gb/webapps/mpp/paypal-popup" class="about_paypal" onclick="javascript:window.open('https://www.paypal.com/gb/webapps/mpp/paypal-popup', 'WIPaypal', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700');
                                                return false;" title="What is PayPal?">What is PayPal?</a>	</label>
                                    <div class="payment_box payment_method_paypal" style="display:none;">
                                        <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
                                    </div>
                                </li>
                            </ul>
                            <div class="form-row place-order">
                                <noscript>
                                Since your browser does not support JavaScript, or it is disabled, please ensure you click the &lt;em&gt;Update Totals&lt;/em&gt; button before placing your order. You may be charged more than the amount stated above if you fail to do so.			&lt;br/&gt;&lt;input type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="Update totals" /&gt;
                                </noscript>



                                <input type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value="Place order" data-value="Place order">

                                <input type="hidden" id="_wpnonce" name="_wpnonce" value="993cc9283e"><input type="hidden" name="_wp_http_referer" value="/checkout/?wc-ajax=update_order_review">	</div>
                        </div>



                    </div>
                </div>
        </div>


        {!! csrf_field() !!}
        </form>

    </div>
</div>
</div>
@endsection
