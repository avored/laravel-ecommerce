<div class="form-group">
    {!!  Form::label('name', 'Name')  !!}
    {!!  Form::text('name',null,array('class'=>'form-control', 'autofocus' => true))  !!}
</div>


@include('mage2::admin._display_errors')

<div class="form-group">
    {!!  Form::button('Save',array(	'onclick' => 'jQuery(this).parents("form:first").submit()', 
    'class' => 'btn btn-primary' ))  !!}
</div>