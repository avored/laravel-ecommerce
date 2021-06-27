<div class="mt-3 flex w-full">
    <avored-select
        label-text="{{ __('Please Select Type') }}"
        field-name="type"
        error-text="{{ $errors->first('type') }}"
        :options="{{ json_encode($typeOptions) }}"
        init-value="{{ $address->type ?? '' }}"
    >
    </avored-select>
</div>

<div class="mt-3 flex w-full">
    <div class="w-1/2">
        <avored-input
            label-text="{{ __('avored.first_name') }}"
            field-name="first_name"
            init-value="{{ $address->first_name ?? '' }}" 
            error-text="{{ $errors->first('first_name') }}"
        >
        </avored-input>
    </div>
    <div class="w-1/2 ml-3">
        <avored-input
            label-text="{{ __('avored.last_name') }}"
            field-name="last_name"
            init-value="{{ $address->last_name ?? '' }}" 
            error-text="{{ $errors->first('last_name') }}"
        >
        </avored-input>
    </div>
</div>
<div class="mt-3 flex w-full">
    <div class="w-1/2">
        <avored-input
            label-text="{{ __('avored.fields.company_name') }}"
            field-name="company_name"
            init-value="{{ $address->company_name ?? '' }}" 
            error-text="{{ $errors->first('company_name') }}"
        >
        </avored-input>
    </div>
    <div class="w-1/2 ml-3">
        <avored-input
            label-text="{{ __('avored.fields.phone') }}"
            field-name="phone"
            init-value="{{ $address->phone ?? '' }}" 
            error-text="{{ $errors->first('phone') }}"
        >
        </avored-input>
    </div>
</div>
<div class="mt-3 flex w-full">
    <div class="w-1/2">
        <avored-input
            label-text="{{ __('avored.fields.address1') }}"
            field-name="address1"
            init-value="{{ $address->address1 ?? '' }}" 
            error-text="{{ $errors->first('address1') }}"
        >
        </avored-input>
    </div>
    <div class="w-1/2 ml-3">
        <avored-input
            label-text="{{ __('avored.fields.address2') }}"
            field-name="address2"
            init-value="{{ $address->address2 ?? '' }}" 
            error-text="{{ $errors->first('address2') }}"
        >
        </avored-input>
    </div>
</div>
<div class="mt-3 flex w-full">
    <div class="w-1/2">
        <avored-input
            label-text="{{ __('avored.fields.postcode') }}"
            field-name="postcode"
            init-value="{{ $address->postcode ?? '' }}" 
            error-text="{{ $errors->first('postcode') }}"
        >
        </avored-input>
    </div>
    <div class="w-1/2 ml-3">
        <avored-select
            label-text="{{ __('Please Select Country') }}"
            field-name="country_id"
            error-text="{{ $errors->first('country_id') }}"
            :options="{{ json_encode($countryOptions) }}"
            init-value="{{ $address->country_id ?? '' }}"
        >
        </avored-select>

    </div>
</div>
<div class="mt-3 flex w-full">
    <div class="w-1/2">
        <avored-input
            label-text="{{ __('avored.fields.state') }}"
            field-name="state"
            init-value="{{ $address->state ?? '' }}" 
            error-text="{{ $errors->first('state') }}"
        >
        </avored-input>
    </div>
    <div class="w-1/2 ml-3">
         <avored-input
            label-text="{{ __('avored.fields.city') }}"
            field-name="city"
            init-value="{{ $address->city ?? '' }}" 
            error-text="{{ $errors->first('city') }}"
        >
        </avored-input>
    </div>
</div>
