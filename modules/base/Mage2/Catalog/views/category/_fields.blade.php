@include('template.text',['key' => 'name','label' => 'Category Name'])
@include('template.text',['key' => 'slug','label' => 'Category Slug'])
@include('template.select',['key' => 'parent_id','label' => 'Parent Category','options' => $categoryOptions])