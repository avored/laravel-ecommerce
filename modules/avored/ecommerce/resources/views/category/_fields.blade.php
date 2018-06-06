



<avored-form-input 
    field-name="name"
    label="Category Name" 
    field-value="{!! $model->name ?? "" !!}" 
        >
</avored-form-input>

<avored-form-input 
    field-name="slug"
    label="Category Slug" 
    field-value="{!! $model->slug ?? "" !!}" 
        >
</avored-form-input>




@include('avored-ecommerce::forms.select',['name' => 'parent_id' ,'label' => 'Parent Category', 'options' => $categoryOptions])
