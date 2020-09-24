<div v-show="useDifferentBillingAddress">
    <h4 class="text-lg text-red-700 font-semibold my-5">
        {{ __('avored.user') }} {{ __('avored.billing_address') }}
    </h4>
    <div v-if="displayBillingDropdown">
        <div class="flex items-center">
            <div class="w-full">
                <div class="mt-3 flex w-full">
                    <avored-select
                        label-text="{{ __('avored.billing_address') }}"
                        error-text="{{ $errors->first('billing.address_id') }}"
                        field-name="field_type"
                        :init-value="initBillingAddress"
                        @input="changeSelectedBillingAddress"
                        :options="billingAddresses"
                    ></avored-select>
                    <input type="hidden" name="billing[address_id]" v-model="billingAddressId" />
                </div>
            </div>
        </div>
    </div>
    <div v-if="billingAddresses.length <= 0  || selectedBillingAddress === null">
        <div class="flex">
            <div class="w-1/2">
                <avored-input
                    label-text="{{ __('avored.first_name') }}"
                    field-name="billing[first_name]"
                    error-text="{{ $errors->first('billing.first_name') }}"
                ></avored-input>
            </div>
            <div class="w-1/2 ml-3">
                <avored-input
                    label-text="{{ __('avored.last_name') }}"
                    field-name="billing[last_name]"
                    error-text="{{ $errors->first('billing.last_name') }}"
                ></avored-input>
            </div>
        </div>

        <div class="flex items-center">
            <div class="w-1/2">
                <avored-input
                    label-text="{{ __('avored.company_name') }}"
                    field-name="billing[company_name]"
                    error-text="{{ $errors->first('billing.company_name') }}"
                ></avored-input>
            </div>
            <div class="w-1/2 ml-3">
                <avored-input
                    label-text="{{ __('avored.phone') }}"
                    field-name="billing[phone]"
                    error-text="{{ $errors->first('billing.phone') }}"
                ></avored-input>
            </div>
        </div>

        <div class="flex items-center">
            <div class="w-1/2">
                <avored-input
                    label-text="{{ __('avored.address1') }}"
                    field-name="billing[address1]"
                    error-text="{{ $errors->first('billing.address1') }}"
                ></avored-input>
            </div>
            <div class="w-1/2 ml-3">
                <avored-input
                    label-text="{{ __('avored.address2') }}"
                    field-name="billing[address2]"
                    error-text="{{ $errors->first('billing.address2') }}"
                ></avored-input>
            </div>
        </div>

        <div class="flex items-center">
            <div class="w-1/2">
                <avored-select
                    label-text="{{ __('avored.country_id') }}"
                    error-text="{{ $errors->first('billing.country_id') }}"
                    field-name="country_id"
                    :options="{{ json_encode($countryOptions) }}"
                >
                </avored-select>
            </div>
            <div class="w-1/2 ml-3">
                <avored-input
                    label-text="{{ __('avored.state') }}"
                    field-name="billing[state]"
                    error-text="{{ $errors->first('billing.state') }}"
                ></avored-input>
            </div>
        </div>

        <div class="flex items-center">
            <div class="w-1/2 ml-3">
                <avored-input
                    label-text="{{ __('avored.postcode') }}"
                    field-name="billing[postcode]"
                    error-text="{{ $errors->first('billing.postcode') }}"
                ></avored-input>
            </div>
            <div class="w-1/2 ml-3">
                <avored-input
                    label-text="{{ __('avored.city') }}"
                    field-name="billing[city]"
                    error-text="{{ $errors->first('billing.city') }}"
                ></avored-input>
            </div>
        </div>
    </div>

    
</div>
