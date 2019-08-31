<a-divider><h4 class="mt-1">{{ __('User Shipping Address') }}</h4></a-divider>

<div v-if="shippingAddresses.length <= 0">

<a-row :gutter="15">
    <a-col :span="12">
        <a-form-item
                @if ($errors->has('shipping.first_name'))
                    validate-status="error"
                    help="{{ $errors->first('shipping.first_name') }}"
                @endif
                label="{{ __('First Name') }}">
            <a-input
                
                name="shipping[first_name]"
                v-decorator="[
                'shipping.first_name',
                {
                    rules: [
                        {   required: true, 
                            message: 'The {{ __('First Name') }} field is required' 
                        }
                    ]
                }
                ]"
            />
        </a-form-item>
    </a-col>
    <a-col :span="12">
        <a-form-item
                @if ($errors->has('shipping.last_name'))
                    validate-status="error"
                    help="{{ $errors->first('shipping.last_name') }}"
                @endif
                label="{{ __('Last Name') }}">
            <a-input
                
                name="shipping[last_name]"
                v-decorator="[
                'shipping.last_name',
                {
                    rules: [
                        {   required: true, 
                            message: 'The {{ __('Last Name') }} field is required' 
                        }
                    ]
                }
                ]"
            />
        </a-form-item>
    </a-col>
</a-row>

<a-row :gutter="15">
    <a-col :span="12">
        <a-form-item
                @if ($errors->has('shipping.company_name'))
                    validate-status="error"
                    help="{{ $errors->first('shipping.company_name') }}"
                @endif
                label="{{ __('Company Name') }}">
            <a-input
                
                name="shipping[company_name]"
                v-decorator="[
                'shipping.company_name',
                {
                    rules: [
                        {   required: false, 
                            message: 'The {{ __('Company Name') }} field is required' 
                        }
                    ]
                }
                ]"
            />
        </a-form-item>
    </a-col>
    <a-col :span="12">
        <a-form-item
                @if ($errors->has('shipping.phone'))
                    validate-status="error"
                    help="{{ $errors->first('shipping.phone') }}"
                @endif
                label="{{ __('Phone') }}">
            <a-input
                
                name="shipping[phone]"
                v-decorator="[
                'shipping.phone',
                {
                    rules: [
                        {   required: true, 
                            message: 'The {{ __('Phone') }} field is required' 
                        }
                    ]
                }
                ]"
            />
        </a-form-item>
    </a-col>
</a-row>

<a-row :gutter="15">
    <a-col :span="12">
        <a-form-item
                @if ($errors->has('shipping.address1'))
                    validate-status="error"
                    help="{{ $errors->first('shipping.address1') }}"
                @endif
                label="{{ __('Address1') }}">
            <a-input
                
                name="shipping[address1]"
                v-decorator="[
                'shipping.address1',
                {
                    rules: [
                        {   required: true, 
                            message: 'The {{ __('Address1') }} field is required' 
                        }
                    ]
                }
                ]"
            />
        </a-form-item>
    </a-col>
    <a-col :span="12">
        <a-form-item
                @if ($errors->has('shipping.address2'))
                    validate-status="error"
                    help="{{ $errors->first('shipping.address2') }}"
                @endif
                label="{{ __('Address2') }}">
            <a-input
                
                name="shipping[address2]"
                v-decorator="[
                'shipping.address2',
                {
                    rules: [
                        {   required: true, 
                            message: 'The {{ __('Address2') }} field is required' 
                        }
                    ]
                }
                ]"
            />
        </a-form-item>
    </a-col>
</a-row>

<a-row :gutter="15">
    <a-col :span="12">
        <a-form-item
                @if ($errors->has('shipping.country_id'))
                    validate-status="error"
                    help="{{ $errors->first('shipping.country_id') }}"
                @endif
                label="{{ __('Country') }}">
                <a-select
                    autocomplete="off"
                    @change="shippingCountryOptionChange"
                    v-decorator="[
                    'shipping.country_id',
                    {
                        rules: [
                            {   required: true, 
                                message: 'The {{ __('Country') }} field is required' 
                            }
                        ]
                    }
                    ]"
                >
                    @foreach ($countryOptions as $countryVal => $countryLabel)
                        <a-select-option value="{{ $countryVal }}">{{ $countryLabel }}</a-select-option>
                    @endforeach
                </a-select>    
        </a-form-item>
        <input type="hidden" name="shipping[country_id]" v-model="shippingCountry" />
    </a-col>
    <a-col :span="12">
        <a-form-item
                @if ($errors->has('shipping.state'))
                    validate-status="error"
                    help="{{ $errors->first('shipping.state') }}"
                @endif
                label="{{ __('State') }}">
            <a-input
                
                name="shipping[state]"
                v-decorator="[
                'shipping.state',
                {
                    rules: [
                        {   required: true, 
                            message: 'The {{ __('State') }} field is required' 
                        }
                    ]
                }
                ]"
            />
        </a-form-item>
    </a-col>
</a-row>

<a-row :gutter="15">
    <a-col :span="12">
        <a-form-item
                @if ($errors->has('shipping.postcode'))
                    validate-status="error"
                    help="{{ $errors->first('shipping.postcode') }}"
                @endif
                label="{{ __('Postcode') }}">
            <a-input
                
                name="shipping[postcode]"
                v-decorator="[
                'shipping.postcode',
                {
                    rules: [
                        {   required: true, 
                            message: 'The {{ __('Postcode') }} field is required' 
                        }
                    ]
                }
                ]"
            />
        </a-form-item>
    </a-col>
    <a-col :span="12">
        <a-form-item
                @if ($errors->has('shipping.city'))
                    validate-status="error"
                    help="{{ $errors->first('shipping.city') }}"
                @endif
                label="{{ __('City') }}">
            <a-input
                
                name="shipping[city]"
                v-decorator="[
                'shipping.city',
                {
                    rules: [
                        {   required: true, 
                            message: 'The {{ __('City') }} field is required' 
                        }
                    ]
                }
                ]"
            />
        </a-form-item>
    </a-col>
</a-row>
</div>

<div v-if="shippingAddresses.length > 0">

<a-row :gutter="15">
    <a-col :span="24">
        <a-form-item label="{{ __('Shipping Addresses') }}">

            <a-select :default-value='0' @change="changeSelectedShippingAddress">
                <a-select-option v-for="(address, index) in shippingAddresses"
                    :key="'shipping-address-' + address.id"
                    :value="index">
                    @{{ address.address1 }} @{{ address.address2 }}
                    @{{ address.city }}
                    @{{ address.state }}
                    @{{ address.country }} @{{ address.postcode }}
                </a-select-option>
            </a-select>
            <input type="hidden" name="shipping[address_id]" :value="selectedShippingAddress.id" />
        </a-form-item>
        
        
        <a-card title="Selected Shipping Address">
            <div>
                @{{ selectedShippingAddress.id }}<br/>
                @{{ selectedShippingAddress.company_name }}<br/>
                @{{ selectedShippingAddress.first_name }} @{{ selectedShippingAddress.last_name }} <br/>
                @{{ selectedShippingAddress.address1 }} @{{ selectedShippingAddress.address2 }} <br/>
                @{{ selectedShippingAddress.city }} <br/>
                @{{ selectedShippingAddress.state }} <br/>
                @{{ selectedShippingAddress.country }} @{{ selectedShippingAddress.postcode }}<br/>
            </div>
        </a-card>
    </a-col>
</a-row>
</div>


<a-switch class="mt-1" @change="useDifferentBillingAddressSwitchChange" default-checked></a-switch>
{{ __('User Different Billing Address') }}
<input type="hidden" name="use_different_address" v-model="useDifferentBillingAddress" />
