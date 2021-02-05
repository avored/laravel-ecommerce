<h4 class="text-lg text-red-700 font-semibold my-5">{{ __('avored.user_shipping_address') }}</h4>

<div v-if="displayShippingDropdown">
    <div class="flex items-center">
        <div class="w-full">
            <div class="mt-3 flex w-full">
                <avored-select
                    label-text="{{ __('Shipping Address') }}"
                    error-text="{{ $errors->first('shipping.address_id') }}"
                    field-name="field_type"
                    @input="changeSelectedShippingAddress"
                    :init-value="initShippingAddress"
                    :options="shippingAddresses"
                ></avored-select>
                <input type="hidden" name="shipping[address_id]" v-model="shippingAddressId" />
            </div>
        </div>
    </div>

</div>

<div v-if="shippingAddresses.length <= 0 || selectedShippingAddress === null">
    <div class="flex">
        <div class="w-1/2">
            <avored-input
                label-text="{{ __('avored.first_name') }}"
                field-name="shipping[first_name]"
                error-text="{{ $errors->first('shipping.first_name') }}"
            ></avored-input>
        </div>
        <div class="w-1/2 ml-3">
            <avored-input
                label-text="{{ __('avored.last_name') }}"
                field-name="shipping[last_name]"
                error-text="{{ $errors->first('shipping.last_name') }}"
            ></avored-input>
        </div>
    </div>

    <div class="flex items-center">
        <div class="w-1/2">
            <avored-input
                label-text="{{ __('avored.fields.company_name') }}"
                field-name="shipping[company_name]"
                error-text="{{ $errors->first('shipping.company_name') }}"
            ></avored-input>
        </div>
        <div class="w-1/2 ml-3">
            <avored-input
                label-text="{{ __('avored.fields.phone') }}"
                field-name="shipping[phone]"
                error-text="{{ $errors->first('shipping.phone') }}"
            ></avored-input>
        </div>
    </div>

    <div class="flex items-center">
        <div class="w-1/2">
            <avored-input
                label-text="{{ __('avored.fields.address1') }}"
                field-name="shipping[address1]"
                error-text="{{ $errors->first('shipping.address1') }}"
            ></avored-input>
        </div>
        <div class="w-1/2 ml-3">
            <avored-input
                label-text="{{ __('avored.fields.address2') }}"
                field-name="shipping[address2]"
                error-text="{{ $errors->first('shipping.address2') }}"
            ></avored-input>
        </div>
    </div>

    <div class="flex items-center">
        <div class="w-1/2">
            <avored-select
                label-text="{{ __('avored.fields.country_id') }}"
                error-text="{{ $errors->first('shipping.country_id') }}"
                field-name="shipping[country_id]"
                :options="{{ json_encode($countryOptions) }}"
            >
            </avored-select>
        </div>
        <div class="w-1/2 ml-3">
            <avored-input
                label-text="{{ __('avored.fields.state') }}"
                field-name="shipping[state]"
                error-text="{{ $errors->first('shipping.state') }}"
            ></avored-input>
        </div>
    </div>

    <div class="flex items-center">
        <div class="w-1/2">
            <avored-input
                label-text="{{ __('avored.fields.postcode') }}"
                field-name="shipping[postcode]"
                error-text="{{ $errors->first('shipping.postcode') }}"
            ></avored-input>
        </div>
        <div class="w-1/2 ml-3">
            <avored-input
                label-text="{{ __('avored.fields.city') }}"
                field-name="shipping[city]"
                error-text="{{ $errors->first('shipping.city') }}"
            ></avored-input>
        </div>
    </div>
</div>

<div class="mt-3 flex w-full">
    <avored-toggle
        label-text="{{ __('User Different Billing Address') }}"
        error-text="{{ $errors->first('use_different_address') }}"
        @input="useDifferentBillingAddressSwitchChange"
        field-name="use_different_address"
        init-value="0"
    > 
    </avored-toggle>
</div>
