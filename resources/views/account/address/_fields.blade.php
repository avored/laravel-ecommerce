<a-row :gutter="15"> 
    <a-col :span="24">
        <a-form-item
            @if ($errors->has('type'))
                validate-status="error"
                help="{{ $errors->first('type') }}"
            @endif
            label="{{ __('Please Select Type') }}">
            <a-select
                @change="handleTypeChange"
                v-decorator="[
                    'type',
                    {{ (isset($address)) ? "{'initialValue': '". $address->type ."'}," : "" }}
                    {rules: 
                        [
                            {   required: true, 
                                message: '{{ __('validation.required', ['attribute' => 'type']) }}' 
                            }
                        ]
                    }
                    ]">
                @foreach ($typeOptions as $val => $label)
                    <a-select-option key="{{ $val }}" value="{{ $val }}" >{{ $label }}</a-select-option>            
                @endforeach
            </a-select>
        </a-form-item>
        <input type="hidden" name="type" v-model="type" />
    </a-col>
</a-row>
<a-row :gutter="15"> 
    <a-col :span="12">
        <a-form-item
            @if ($errors->has('first_name'))
                validate-status="error"
                help="{{ $errors->first('first_name') }}"
            @endif
            label="{{ __('First Name') }}"
        >
            <a-input
                :auto-focus="true"
                name="first_name"
                v-decorator="[
                'first_name',
                {{ (isset($address)) ? "{'initialValue': '". $address->first_name ."'}," : "" }}
                {rules: 
                    [
                        {   required: true, 
                            message: '{{ __('validation.required', ['attribute' => 'first_name']) }}' 
                        }
                    ]
                }
                ]"
            ></a-input>
        </a-form-item>
    </a-col>
    <a-col :span="12">
        <a-form-item
            @if ($errors->has('last_name'))
                validate-status="error"
                help="{{ $errors->first('last_name') }}"
            @endif
            label="{{ __('Last Name') }}"
        >
            <a-input
                :auto-focus="true"
                name="last_name"
                v-decorator="[
                'last_name',
                {{ (isset($address)) ? "{'initialValue': '". $address->last_name ."'}," : "" }}
                {rules: 
                    [
                        {   required: true, 
                            message: '{{ __('validation.required', ['attribute' => 'last_name']) }}' 
                        }
                    ]
                }
                ]"
            ></a-input>
        </a-form-item>
    </a-col>
</a-row>


<a-row :gutter="15"> 
    <a-col :span="12">
        <a-form-item
            @if ($errors->has('company_name'))
                validate-status="error"
                help="{{ $errors->first('company_name') }}"
            @endif
            label="{{ __('Company Name') }}"
        >
            <a-input
                :auto-focus="true"
                name="company_name"
                v-decorator="[
                'company_name',
                {{ (isset($address)) ? "{'initialValue': '". $address->company_name ."'}," : "" }}
                {rules: 
                    [
                        {   required: false, 
                            message: '{{ __('validation.required', ['attribute' => 'company_name']) }}' 
                        }
                    ]
                }
                ]"
            ></a-input>
        </a-form-item>
    </a-col>
    <a-col :span="12">
        <a-form-item
            @if ($errors->has('phone'))
                validate-status="error"
                help="{{ $errors->first('phone') }}"
            @endif
            label="{{ __('Phone') }}"
        >
            <a-input
                :auto-focus="true"
                name="phone"
                v-decorator="[
                'phone',
                {{ (isset($address)) ? "{'initialValue': '". $address->phone ."'}," : "" }}
                {rules: 
                    [
                        {   required: true, 
                            message: '{{ __('validation.required', ['attribute' => 'phone']) }}' 
                        }
                    ]
                }
                ]"
            ></a-input>
        </a-form-item>
    </a-col>
    
</a-row>


<a-row :gutter="15"> 
    <a-col :span="12">
        <a-form-item
            @if ($errors->has('address1'))
                validate-status="error"
                help="{{ $errors->first('address1') }}"
            @endif
            label="{{ __('Address1') }}"
        >
            <a-input
                :auto-focus="true"
                name="address1"
                v-decorator="[
                'address1',
                {{ (isset($address)) ? "{'initialValue': '". $address->address1 ."'}," : "" }}
                {rules: 
                    [
                        {   required: true, 
                            message: '{{ __('validation.required', ['attribute' => 'address1']) }}' 
                        }
                    ]
                }
                ]"
            ></a-input>
        </a-form-item>
    </a-col>
    <a-col :span="12">
        <a-form-item
            @if ($errors->has('address2'))
                validate-status="error"
                help="{{ $errors->first('address2') }}"
            @endif
            label="{{ __('Address2') }}"
        >
            <a-input
                :auto-focus="true"
                name="address2"
                v-decorator="[
                'address2',
                {{ (isset($address)) ? "{'initialValue': '". $address->address2 ."'}," : "" }}
                {rules: 
                    [
                        {   required: false, 
                            message: '{{ __('validation.required', ['attribute' => 'address2']) }}' 
                        }
                    ]
                }
                ]"
            ></a-input>
        </a-form-item>
    </a-col>
</a-row>

<a-row :gutter="15"> 
    <a-col :span="12">
        <a-form-item
            @if ($errors->has('postcode'))
                validate-status="error"
                help="{{ $errors->first('postcode') }}"
            @endif
            label="{{ __('Postcode') }}"
        >
            <a-input
                :auto-focus="true"
                name="postcode"
                v-decorator="[
                'postcode',
                {{ (isset($address)) ? "{'initialValue': '". $address->postcode ."'}," : "" }}
                {rules: 
                    [
                        {   required: true, 
                            message: '{{ __('validation.required', ['attribute' => 'postcode']) }}' 
                        }
                    ]
                }
                ]"
            ></a-input>
        </a-form-item>
    </a-col>
    <a-col :span="12">
        <a-form-item
            @if ($errors->has('country_id'))
                validate-status="error"
                help="{{ $errors->first('country_id') }}"
            @endif
            label="{{ __('Country') }}"
        >
                <a-select
                    @change="handleCountryChange"
                    v-decorator="[
                        'country_id',
                        {{ (isset($address)) ? "{'initialValue': '". $address->country_id ."'}," : "" }}
                        {rules: 
                            [
                                {   required: true, 
                                    message: '{{ __('validation.required', ['attribute' => 'country_id']) }}' 
                                }
                            ]
                        }
                        ]">
                @foreach ($countryOptions as $val => $label)
                    <a-select-option key="country-{{ $val }}" value="{{ $val }}" >{{ $label }}</a-select-option>            
                @endforeach
            </a-select>
        </a-form-item>
        <input type="hidden" name="country_id" v-model="country_id" />
    </a-col>
</a-row>

<a-row :gutter="15"> 
    <a-col :span="12">
        <a-form-item
            @if ($errors->has('state'))
                validate-status="error"
                help="{{ $errors->first('state') }}"
            @endif
            label="{{ __('State') }}"
        >
            <a-input
                :auto-focus="true"
                name="state"
                v-decorator="[
                'state',
                {{ (isset($address)) ? "{'initialValue': '". $address->state ."'}," : "" }}
                {rules: 
                    [
                        {   required: true, 
                            message: '{{ __('validation.required', ['attribute' => 'state']) }}' 
                        }
                    ]
                }
                ]"
            ></a-input>
        </a-form-item>
    </a-col>
    <a-col :span="12">
        <a-form-item
            @if ($errors->has('city'))
                validate-status="error"
                help="{{ $errors->first('city') }}"
            @endif
            label="{{ __('City') }}"
        >
            <a-input
                :auto-focus="true"
                name="city"
                v-decorator="[
                'city',
                {{ (isset($address)) ? "{'initialValue': '". $address->city ."'}," : "" }}
                {rules: 
                    [
                        {   required: false, 
                            message: '{{ __('validation.required', ['attribute' => 'city']) }}' 
                        }
                    ]
                }
                ]"
            ></a-input>
        </a-form-item>
    </a-col>
</a-row>

