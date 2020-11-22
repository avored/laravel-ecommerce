<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */
    'accepted' => ':attribute باید مورد قبول باشد',
    'active_url' => ':attribute یک مسیر مورد تایید نمیباشد',
    'after' => ':attribute باید یک تاریخ بعد از:date باشد.',
    'after_or_equal' => ':attribute باید یک تاریخ بعد یا برابر با:date باشد',
    'alpha' => ':attribute باید فقط شامل حروف باشد',
    'alpha_dash' => ':attribute باید فقط شامل حروف و اعداد و خط تیره و زیر خط باشد',
    'alpha_num' => ':attribute فقط باید شامل حروف و اعداد باشد',
    'array' => ':attribute باید یک آرایه باشد',
    'before' => ':attribute باید یک تاریخ قبل از :date باشد.',
    'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
    'before_or_equal' => ':attribute باید یک تاریخ قبل یا برابر با :date باشد.',
    'between' => [
        'numeric' => ':attribute باید ما بین :min و :max باشد.',
        'file' => ':attribute  باید مابین :min و :max کیلو بایت باشد.',
        'string' => ':attribute باید مابین :min و :max کارکتر باشد.',
        'array' => ':attribute باید مابین :min و  :max آیتم باشد.',
    ],
    'boolean' => ':attribute مقادیر باید صحیح یا غلط باشند',
    'confirmed' => ':attribute مطابقت برقرار نمی باشد',
    'date' => ':attribute یک تاریخ معتبر نمی باشد',
    'date_equals' => ':attribute باید یک تاریخ برابر با :date باشد.',
    'date_format' => ':attribute با این فرمت :format مطابقت ندارد.',
    'different' => ':attribute و :other باید تفاوت داشته باشند.',
    'digits' => ':attribute باید این اعداد باشد :digits',
    'digits_between' => ':attribute باید مابین :min و :max باشد.',
    'dimensions' => ':attribute از ابعاد اشتباه برخوردار است',
    'distinct' => ':attribute مقدار تکراری دارد',
    'email' => ':attribute باید یک آدرس ایمیل معتبر باشد',
    'ends_with' => ':attribute باید با یکی از این مقادیر پایان یابد: :values',
    'exists' => ':attribute انتخاب شده اشتباه است.',
    'file' => ':attribute باید یک فایل باشد.',
    'filled' => ':attribute باید یک مقدار داشته باشد',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'numeric' => ':attribute باید بزرگتر تر از :value باشد.',
        'file' => ':attribute باید بزرگتر از :value کیلوبایت.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => 'The :attribute must be an image.',
    'in' => 'The selected :attribute is invalid.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => 'The :attribute must be an integer.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'The :attribute may not be greater than :max.',
        'file' => 'The :attribute may not be greater than :max kilobytes.',
        'string' => 'The :attribute may not be greater than :max characters.',
        'array' => 'The :attribute may not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => 'The :attribute must be at least :min.',
        'file' => 'The :attribute must be at least :min kilobytes.',
        'string' => 'The :attribute must be at least :min characters.',
        'array' => 'The :attribute must have at least :min items.',
    ],
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'present' => 'The :attribute field must be present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => 'The :attribute field is required.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid zone.',
    'unique' => 'The :attribute has already been taken.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute format is invalid.',
    'uuid' => 'The :attribute must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
