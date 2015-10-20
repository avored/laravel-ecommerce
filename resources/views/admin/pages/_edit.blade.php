<div class="form-group">
    {!!  Form::label('name', 'Name')  !!}
    {!!  Form::text('name',null,array('class'=>'form-control', 'autofocus' => true))  !!}
    @if($errors->has('name'))
        <p class="alert alert-danger">{!! $errors->first('name') !!}</p>
    @endif
</div>

<div class="form-group">
    {!!  Form::label('slug', 'Slug')  !!}
    {!!  Form::text('slug',null,array('class'=>'form-control', 'autofocus' => true))  !!}

</div>

<div class="form-group">
    {!!  Form::label('content', 'Content')  !!}
    {!!  Form::textarea('content',null,array('class'=>'form-control'))  !!}
</div>

<div class="form-group">
    {!!  Form::button('Save',array(	'onclick' => 'jQuery(this).parents("form:first").submit()', 
    'class' => 'btn btn-primary' ))  !!}
</div>