<div class="form-group">
    {!!  Form::label('name', 'Name')  !!}
    {!!  Form::text('name',null,array('class'=>'form-control', 'autofocus' => true))  !!}
</div>

<div class="form-group">
    {!!  Form::label('dummy_slug', 'Slug')  !!}
    {!!  Form::text('dummy_slug',null,array('class'=>'form-control','disabled' => true))  !!}
</div>

<div class="form-group">
    {!!  Form::label('parent_category_id', 'Parent Category')  !!}
    {!!  Form::select('parent_category_id', $categories , null,array('class'=>'form-control'))  !!}
</div>

<div class="form-group">
    {!!  Form::label('description', 'Description')  !!}
    {!!  Form::textarea('description',null,array('class'=>'form-control'))  !!}
</div>

<div class="form-group">
    <?php if(isset($category->image_path) && $category->image_path != "" ) { ?>
        <div class="image_list">
            <img src="{{ url($category->image_path) }}" width="150" alt="{{ $category->name }}" />
        </div>
    <?php } ?>
    
    {!!  Form::label('file', 'Image')  !!}
    {!!  Form::file('file',null,array('class'=>'form-control'))  !!}
</div>

<div class="form-group">
    {!!  Form::label('status', 'Status')  !!}
    {!!  Form::select('status', [ 1 => 'Yes', 0 => 'No'], null,array('class'=>'form-control'))  !!}
</div>

<?php
/**

 <?php  $id = (isset($category->id) ? $category->id : null );
foreach($entity->attributes()->get() as $attribute)
    AdminAttribute::renderCategoryAttribute($attribute, $id) !!}
endforeach
*/
?>


<div class="form-group">
    {!!  Form::button('Save',array(	'onclick' => 'jQuery(this).parents("form:first").submit()', 
    'class' => 'btn btn-primary' ))  !!}
</div>

