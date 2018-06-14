


<avored-form-input 
    field-name="name"
    label="Category Name" 
    field-value="{!! $model->name ?? "" !!}" 
    error-text="{!! $errors->first('name') !!}"
    v-on:change="changeModelValue"
    autofocus="autofocus"
        >
</avored-form-input>

<avored-form-input 
    field-name="slug"
    label="Category Slug" 
    field-value="{!! $model->slug ?? "" !!}" 
    error-text="{!! $errors->first('slug') !!}"
    v-on:change="changeModelValue"
        >
</avored-form-input>


<avored-form-select 
    field-name="parent_id"
    label="Parent Category" 
    error-text="{!! $errors->first('parent_id') !!}"
    field-options='{!! $categoryOptions !!}'
    field-value="{!! $model->parent_id ?? "" !!}" 
    v-on:change="changeModelValue"
        >
</avored-form-select>