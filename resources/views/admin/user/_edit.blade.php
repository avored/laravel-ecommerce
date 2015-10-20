<div class="form-group">
    {!!  Form::label('first_name', 'First Name')  !!}
    {!!  Form::text('first_name',null,array('class'=>'form-control', 'autofocus' => true))  !!}
    @if($errors->has('first_name'))
        <p class="alert alert-danger">{!! $errors->first('name') !!}</p>
    @endif
</div>

<div class="form-group">
    {!!  Form::label('last_name', 'Last Name')  !!}
    {!!  Form::text('last_name',null,array('class'=>'form-control'))  !!}

</div>

<div class="form-group">
    {!!  Form::label('email', 'Email')  !!}
    {!!  Form::text('email',null,array('class'=>'form-control'))  !!}

</div>

<div class="form-group">
    {!!  Form::label('phone', 'Phone')  !!}
    {!!  Form::text('phone',null,array('class'=>'form-control'))  !!}
</div>

<div class="form-group">
    {!!  Form::button('Save',array(	'onclick' => 'jQuery(this).parents("form:first").submit()', 
    'class' => 'btn btn-primary' ))  !!}
</div>