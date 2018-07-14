<div class="card mt-3">
    <div class="card-header">Your Address</div>

    <div class="card-body">

        <div id="payment-address-new">

            @php
                $address = NULL;
                if (NULL !== $user) {
                    $address = $user->getBillingAddress();
                }
            @endphp

            @if(NULL === $address)
                <div class="form-group">
                    <label class="control-label" for="input-billing-address-1">Address 1</label>
                    <input type="text" name="billing[address1]" value="" placeholder="Address 1"
                           id="input-billing-address-1"
                           @if($errors->has('billing.address1'))
                           class="is-invalid avored-checkout-field form-control"
                           @else
                           class="form-control avored-checkout-field"
                            @endif
                    />
                    @if ($errors->has('billing.address1'))
                        <div class="invalid-feedback">
                            {{ $errors->first('billing.address1') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label class="control-label" for="input-billing-address-2">Address 2</label>
                    <input type="text" name="billing[address2]" value="" placeholder="Address 2"
                           id="input-billing-address-2"

                           @if($errors->has('billing.address2'))
                           class="is-invalid avored-checkout-field form-control"
                           @else
                           class="form-control avored-checkout-field"
                            @endif
                    />

                    @if ($errors->has('billing.address2'))
                        <div class="invalid-feedback">
                            {{ $errors->first('billing.address2') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="country">Country</label>
                    <select name="billing[country_id]" data-name="country_id"
                            class="{{ $errors->has('billing.country_id') ? "is-invalid" : "" }}
                                    billing-country avored-checkout-field form-control billing tax-calculation"
                    >
                        @foreach($countries as $countryId => $countryName)
                            <option
                                    value="{{ $countryId }}">{{ $countryName }}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('billiing.country_id'))
                        <div class="invalid-feedback">
                            {{ $errors->first('billing.country_id') }}
                        </div>
                    @endif
                </div>

                <div class="row">
                    <div class="form-group col-6">
                        <label class="control-label" for="input-billing-zone">Region /
                            State</label>
                        <input type="text" name="billing[state]" data-name="state_code"
                               id="input-billing-zone"


                               @if($errors->has('billing.state'))
                               class="is-invalid avored-checkout-field billing tax-calculation form-control"
                               @else
                               class="billing avored-checkout-field tax-calculation form-control"
                                @endif
                        />
                        @if ($errors->has('billing.state'))
                            <div class="invalid-feedback">
                                {{ $errors->first('billing.state') }}
                            </div>
                        @endif

                    </div>


                    <div class="form-group  col-6">
                        <label class="control-label" for="input-billing-city">City</label>
                        <input type="text" data-name="city" name="billing[city]"
                               placeholder="City"
                               id="input-billing-city"

                               @if($errors->has('billing.city'))
                               class="is-invalid avored-checkout-field billing tax-calculation form-control"
                               @else
                               class="billing avored-checkout-field tax-calculation form-control"
                                @endif
                        />
                        @if ($errors->has('billing.city'))
                            <div class="invalid-feedback">
                                {{ $errors->first('billing.city') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label" for="input-billing-postcode">Post Code</label>
                    <input type="text" data-name="postcode" name="billing[postcode]" value=""
                           placeholder="Post Code"
                           id="input-billing-postcode"

                           @if($errors->has('billing.postcode'))
                           class="is-invalid avored-checkout-field shipping_calc billing tax-calculation form-control"
                           @else
                           class="billing avored-checkout-field shipping_calc tax-calculation form-control"
                            @endif
                    />
                    @if ($errors->has('billing.postcode'))
                        <div class="invalid-feedback">
                            {{ $errors->first('billing.postcode') }}
                        </div>
                    @endif
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
                <label for="use_different_shipping_address">
                    <input  type="checkbox" 
                            id="use_different_shipping_address" 
                            name="use_different_shipping_address"
                            class="avored-checkout-field"
                            onclick="if (this.checked == true){
                                        jQuery('.different-shipping-form').css('display','block');
                                    } else  { 
                                        jQuery('.different-shipping-form').css('display','none'); 
                                    }
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
                           id="input-billing-firstname"

                           @if($errors->has('shipping.first_name'))
                           class="is-invalid avored-checkout-field form-control"
                           @else
                           class="form-control avored-checkout-field"
                            @endif
                    />
                    @if ($errors->has('shipping.first_name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('shipping.first_name') }}
                        </div>
                    @endif
                </div>
                <div class="form-group  col-6">
                    <label class="control-label" for="input-billing-lastname">Last Name</label>
                    <input type="text" name="shipping[last_name]"
                           value="" placeholder="Last Name"
                           id="input-billing-lastname"
                           @if($errors->has('shipping.last_name'))
                           class="is-invalid avored-checkout-field form-control"
                           @else
                           class="form-control avored-checkout-field"
                            @endif
                    />
                    @if ($errors->has('shipping.last_name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('shipping.last_name') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="control-label" for="input-shipping-address-1">Address 1</label>
                <input type="text" name="shipping[address1]" value="" placeholder="Address 1"
                       id="input-shipping-address-1"
                       @if($errors->has('shipping.address1'))
                       class="is-invalid avored-checkout-field  form-control"
                       @else
                       class="form-control avored-checkout-field"
                        @endif
                />
                @if ($errors->has('shipping.address1'))
                    <div class="invalid-feedback">
                        {{ $errors->first('shipping.address1') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label class="control-label" for="input-shipping-address-2">Address 2</label>
                <input type="text" name="shipping[address2]" value="" placeholder="Address 2"
                       id="input-shipping-address-2"
                       @if($errors->has('shipping.address2'))
                       class="is-invalid avored-checkout-field form-control"
                       @else
                       class="form-control avored-checkout-field"
                        @endif
                />
                @if ($errors->has('shipping.address2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('shipping.address2') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label for="input-shipping-country-id">Country</label>
                <select name="shipping[country_id]" data-name="country_id"

                        id="input-shipping-country-id"
                        @if($errors->has('shipping.country_id'))
                        class="is-invalid avored-checkout-field shipping tax-calculation form-control"
                        @else
                        class="shipping avored-checkout-field tax-calculation form-control"
                        @endif
                />


                @foreach($countries as $countryId => $countryName)
                    <option
                            value="{{ $countryId }}">{{ $countryName }}</option>
                    @endforeach
                    </select>

                    @if ($errors->has('shipping.country_id'))
                        <div class="invalid-feedback">
                            {{ $errors->first('shipping.country_id') }}
                        </div>
                    @endif
            </div>

            <div class="row">
                <div class="form-group col-6">
                    <label class="control-label" for="input-shipping-zone">Region /
                        State</label>
                    <input type="text" data-name="state_code" name="shipping[state]"
                           id="input-shipping-zone"

                           @if($errors->has('shipping.state'))
                           class="is-invalid avored-checkout-field shipping tax-calculation form-control"
                           @else
                           class="shipping avored-checkout-field tax-calculation form-control"
                            @endif
                    />
                    @if ($errors->has('shipping.state'))
                        <div class="invalid-feedback">
                            {{ $errors->first('shipping.state') }}
                        </div>
                    @endif
                </div>


                <div class="form-group  col-6">
                    <label class="control-label" for="input-shipping-city">City</label>
                    <input type="text" data-name="city" name="shipping[city]" placeholder="City"
                           id="input-shipping-city"
                           @if($errors->has('shipping.city'))
                           class="is-invalid avored-checkout-field shipping tax-calculation form-control"
                           @else
                           class="shipping avored-checkout-field tax-calculation form-control"
                            @endif
                    />
                    @if ($errors->has('shipping.country_id'))
                        <div class="invalid-feedback">
                            {{ $errors->first('shipping.city') }}
                        </div>
                    @endif

                </div>
            </div>

            <div class="row">
                <div class="form-group col-6">
                    <label class="control-label" for="input-shipping-postcode">Post Code</label>
                    <input type="text" data-name="postcode" name="shipping[postcode]" value=""
                           placeholder="Post Code"
                           id="input-shipping-postcode"
                           @if($errors->has('shipping.postcode'))
                           class="is-invalid avored-checkout-field shipping tax-calculation form-control"
                           @else
                           class="shipping avored-checkout-field tax-calculation form-control"
                            @endif
                    />
                    @if ($errors->has('shipping.postcode'))
                        <div class="invalid-feedback">
                            {{ $errors->first('shipping.postcode') }}
                        </div>
                    @endif
                </div>

                <div class="form-group   col-6">
                    <label class="control-label" for="input-shipping-phone">Phone</label>
                    <input type="text" name="shipping[phone]" value="" placeholder="Phone"
                           id="input-shipping-phone"
                           @if($errors->has('shipping.phone'))
                           class="is-invalid avored-checkout-field form-control"
                           @else
                           class="form-control avored-checkout-field" 
                            @endif
                    />
                    @if ($errors->has('shipping.phone'))
                        <div class="invalid-feedback">
                            {{ $errors->first('shipping.phone') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>