<div v-if="useDifferentBillingAddress">

<a-divider><h4 class="mt-1">{{ __('User Billing Address') }}</h4></a-divider>

<div v-if="billingAddresses.length <= 0">

<a-row :gutter="15">
    <a-col :span="12">
        <a-form-item
                @if ($errors->has('billing.first_name'))
                    validate-status="error"
                    help="{{ $errors->first('billing.first_name') }}"
                @endif
                label="{{ __('First Name') }}">
            <a-input
                name="billing[first_name]"
                v-decorator="[
                'billing.first_name',
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
                @if ($errors->has('billing.last_name'))
                    validate-status="error"
                    help="{{ $errors->first('billing.last_name') }}"
                @endif
                label="{{ __('Last Name') }}">
            <a-input
                
                name="billing[last_name]"
                v-decorator="[
                'billing.last_name',
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
                @if ($errors->has('billing.company_name'))
                    validate-status="error"
                    help="{{ $errors->first('billing.company_name') }}"
                @endif
                label="{{ __('Company Name') }}">
            <a-input
                
                name="billing[company_name]"
                v-decorator="[
                'billing.company_name',
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
                @if ($errors->has('billing.phone'))
                    validate-status="error"
                    help="{{ $errors->first('billing.phone') }}"
                @endif
                label="{{ __('Phone') }}">
            <a-input
                
                name="billing[phone]"
                v-decorator="[
                'billing.phone',
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
                @if ($errors->has('billing.address1'))
                    validate-status="error"
                    help="{{ $errors->first('billing.address1') }}"
                @endif
                label="{{ __('Address1') }}">
            <a-input
                
                name="billing[address1]"
                v-decorator="[
                'billing.address1',
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
                @if ($errors->has('billing.address2'))
                    validate-status="error"
                    help="{{ $errors->first('billing.address2') }}"
                @endif
                label="{{ __('Address2') }}">
            <a-input
                
                name="billing[address2]"
                v-decorator="[
                'billing.address2',
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
                @if ($errors->has('billing.country_id'))
                    validate-status="error"
                    help="{{ $errors->first('billing.country_id') }}"
                @endif
                label="{{ __('Country') }}">
            <a-select
                    autocomplete="off"
                    @change="billingCountryOptionChange"
                    v-decorator="[
                    'billing.country_id',
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
        <input type="hidden" name="billing[country_id]" v-model="billingCountry" />
    </a-col>
    <a-col :span="12">
        <a-form-item
                @if ($errors->has('billing.state'))
                    validate-status="error"
                    help="{{ $errors->first('billing.state') }}"
                @endif
                label="{{ __('State') }}">
            <a-input
                
                name="billing[state]"
                v-decorator="[
                'billing.state',
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
                @if ($errors->has('billing.postcode'))
                    validate-status="error"
                    help="{{ $errors->first('billing.postcode') }}"
                @endif
                label="{{ __('Postcode') }}">
            <a-input
                
                name="billing[postcode]"
                v-decorator="[
                'billing.postcode',
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
                @if ($errors->has('billing.city'))
                    validate-status="error"
                    help="{{ $errors->first('billing.city') }}"
                @endif
                label="{{ __('City') }}">
            <a-input
                
                name="billing[city]"
                v-decorator="[
                'billing.city',
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


<div v-if="billingAddresses.length > 0">

<a-row :gutter="15">
    <a-col :span="24">
        <a-form-item label="{{ __('Billing Addresses') }}">

            <a-select :default-value='0' @change="changeSelectedBillingAddress">
                <a-select-option v-for="(address, index) in billingAddresses" :key="'billing-address-' + address.id" :value="index">
                    @{{ address.address1 }} @{{ address.address2 }}
                    @{{ address.city }}
                    @{{ address.state }}
                    @{{ address.country }} @{{ address.postcode }}
                </a-select-option>
            </a-select>
            <input type="hidden" name="billing[address_id]" :value="selectedBillingAddress.id" />
        </a-form-item>
        
        
        <a-card title="Selected Billing Address">
            <div>
                @{{ selectedBillingAddress.id }}<br/>
                @{{ selectedBillingAddress.company_name }}<br/>
                @{{ selectedBillingAddress.first_name }} @{{ selectedBillingAddress.last_name }} <br/>
                @{{ selectedBillingAddress.address1 }} @{{ selectedBillingAddress.address2 }} <br/>
                @{{ selectedBillingAddress.city }} <br/>
                @{{ selectedBillingAddress.state }} <br/>
                @{{ selectedBillingAddress.country }} @{{ selectedBillingAddress.postcode }}<br/>
            </div>
        </a-card>
    </a-col>
</a-row>
</div>

</div>
