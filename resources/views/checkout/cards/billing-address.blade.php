<div v-if="useDifferentBillingAddress">
    <h4 class="text-lg text-red-700 font-semibold my-5">{{ __('User Billing Address') }}</h4>

    <div v-if="billingAddresses.length <= 0">
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
                    label-text="{{ __('Billing Country') }}"
                    error-text="{{ $errors->first('billing.country_id') }}"
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

    <div v-if="billingAddresses.length > 0">

        <div class="flex items-center">
            <div class="w-full">
                <div class="mt-3 flex w-full">
                    <avored-select
                        label-text="{{ __('Billing Address') }}"
                        error-text="{{ $errors->first('billing.address_id') }}"
                        field-name="field_type"
                        :init-value="initBillingAddress"
                        :options="billingAddresses"
                    ></avored-select>
                </div>
            
                
                
                <div class="border shadow">
                    <div class="text-xl p-5 border-b">
                        Selected Billing Address
                    </div>
                    <div class="p-5">
                        @{{ selectedBillingAddress.company_name }}<br/>
                        @{{ selectedBillingAddress.first_name }} @{{ selectedBillingAddress.last_name }} <br/>
                        @{{ selectedBillingAddress.address1 }} @{{ selectedBillingAddress.address2 }} <br/>
                        @{{ selectedBillingAddress.city }} <br/>
                        @{{ selectedBillingAddress.state }} <br/>
                        @{{ selectedBillingAddress.country.name }} @{{ selectedBillingAddress.postcode }}<br/>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
