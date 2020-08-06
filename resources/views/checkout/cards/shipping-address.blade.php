<h4 class="text-lg text-red-700 font-semibold my-5">{{ __('User Shipping Address') }}</h4>

<div v-if="shippingAddresses.length <= 0">
    <div class="flex">
        <div class="w-1/2">
            <avored-input
                label-text="{{ __('First Name') }}"
                field-name="shopping[first_name]"
                error-text="{{ $errors->first('shopping.first_name') }}"
            ></avored-input>
        </div>
        <div class="w-1/2 ml-3">
            <avored-input
                label-text="{{ __('Last Name') }}"
                field-name="shopping[last_name]"
                error-text="{{ $errors->first('shopping.last_name') }}"
            ></avored-input>
        </div>
    </div>

    <div class="flex items-center">
        <div class="w-1/2">
            <avored-input
                label-text="{{ __('Company Name') }}"
                field-name="shopping[company_name]"
                error-text="{{ $errors->first('shopping.company_name') }}"
            ></avored-input>
        </div>
        <div class="w-1/2 ml-3">
            <avored-input
                label-text="{{ __('Phone Number') }}"
                field-name="shopping[phone]"
                error-text="{{ $errors->first('shopping.phone') }}"
            ></avored-input>
        </div>
    </div>

    <div class="flex items-center">
        <div class="w-1/2">
            <avored-input
                label-text="{{ __('Address 1') }}"
                field-name="shopping[address1]"
                error-text="{{ $errors->first('shopping.address1') }}"
            ></avored-input>
        </div>
        <div class="w-1/2 ml-3">
            <avored-input
                label-text="{{ __('Address 2') }}"
                field-name="shopping[address2]"
                error-text="{{ $errors->first('shopping.address2') }}"
            ></avored-input>
        </div>
    </div>

    <div class="flex items-center">
        <div class="w-1/2">
            <avored-select
                label-text="{{ __('Shipping Country') }}"
                error-text="{{ $errors->first('shipping.country_id') }}"
                field-name="country_id"
                :options="{{ json_encode($countryOptions) }}"
            >
            </avored-select>
        </div>
        <div class="w-1/2 ml-3">
            <avored-input
                label-text="{{ __('State') }}"
                field-name="shopping[state]"
                error-text="{{ $errors->first('shopping.state') }}"
            ></avored-input>
        </div>
    </div>

    <div class="flex items-center">
        <div class="w-1/2 ml-3">
            <avored-input
                label-text="{{ __('Postcode') }}"
                field-name="shopping[postcode]"
                error-text="{{ $errors->first('shopping.postcode') }}"
            ></avored-input>
        </div>
        <div class="w-1/2 ml-3">
            <avored-input
                label-text="{{ __('City') }}"
                field-name="shopping[city]"
                error-text="{{ $errors->first('shopping.city') }}"
            ></avored-input>
        </div>
    </div>
</div>

<div v-if="shippingAddresses.length > 0">

    <div class="flex items-center">
        <div class="w-full">
            <div class="mt-3 flex w-full">
                <avored-select
                    label-text="{{ __('Shipping Address') }}"
                    error-text="{{ $errors->first('shipping.address_id') }}"
                    field-name="field_type"
                    :options="shippingAddresses"
                >
                </avored-select>
            </div>
        
            
            
            <div class="border shadow">
                <div class="text-xl p-5 border-b">
                    Selected Shipping Address
                </div>
                <div>
                    @{{ selectedShippingAddress.id }}<br/>
                    @{{ selectedShippingAddress.company_name }}<br/>
                    @{{ selectedShippingAddress.first_name }} @{{ selectedShippingAddress.last_name }} <br/>
                    @{{ selectedShippingAddress.address1 }} @{{ selectedShippingAddress.address2 }} <br/>
                    @{{ selectedShippingAddress.city }} <br/>
                    @{{ selectedShippingAddress.state }} <br/>
                    @{{ selectedShippingAddress.country }} @{{ selectedShippingAddress.postcode }}<br/>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="mt-3 flex w-full">
    <avored-toggle
        label-text="{{ __('User Different Billing Address') }}"
        error-text="{{ $errors->first('use_different_address') }}"
        @change="useDifferentBillingAddressSwitchChange"
        field-name="use_different_address"
        init-value="1"
    >
    </avored-toggle>
</div>
