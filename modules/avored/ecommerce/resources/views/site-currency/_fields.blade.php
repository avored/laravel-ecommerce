


<avored-form-input 
    field-name="name"
    label="Name" 
    field-value="{!! $model->name ?? "" !!}" 
    error-text="{!! $errors->first('name') !!}"
    v-on:change="changeModelValue"
    autofocus="autofocus"
        >
</avored-form-input>



<avored-form-select 
    field-name="code"
    label="Currency Code" 
    error-text="{!! $errors->first('code') !!}"
    field-options='{!! $codeOptions !!}'
    field-value="{!! $model->code ?? "" !!}" 
    v-on:change="changeModelValue"
        >
</avored-form-select>


<avored-form-input 
    field-name="conversion_rate"
    label="Conversion Rate" 
    field-value="{!! $model->conversion_rate ?? "" !!}" 
    error-text="{!! $errors->first('conversion_rate') !!}"
    v-on:change="changeModelValue"
        >
</avored-form-input>


<avored-form-select 
    field-name="status"
    label="Status" 
    error-text="{!! $errors->first('status') !!}"
    field-options='{!! $statusOptions !!}'
    field-value="{!! $model->status ?? "" !!}" 
    v-on:change="changeModelValue"
        >
</avored-form-select>