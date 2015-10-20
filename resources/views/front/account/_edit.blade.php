<div class="form-group">
    {!!  Form::label('number', 'Street Number/House No')  !!}
    {!!  Form::text('number',null,array('class'=>'form-control', 'autofocus' => true))  !!}
</div>

<div class="form-group">
    {!!  Form::label('street', 'Street Name')  !!}
    {!!  Form::text('street',null,array('class'=>'form-control'))  !!}
</div>

<div class="form-group">
    {!!  Form::label('area', 'Area Name')  !!}
    {!!  Form::text('area',null,array('class'=>'form-control'))  !!}
</div>

<div class="form-group">
    {!!  Form::label('city', 'City')  !!}
    {!!  Form::text('city',null,array('class'=>'form-control'))  !!}
</div>

<div class="form-group">
    {!!  Form::label('state', 'State')  !!}
    {!!  Form::text('state',null,array('class'=>'form-control'))  !!}
</div>

<div class="form-group">
    {!!  Form::label('zip_code', 'Zip Code')  !!}
    {!!  Form::text('zip_code',null,array('class'=>'form-control'))  !!}
</div>

<div class="form-group">
    {!!  Form::label('country', 'Country')  !!}
    {!!  Form::text('country',null,array('class'=>'form-control'))  !!}
</div>
@include('mage2::front._display_errors')

<div class="form-group">
    {!!  Form::button('Save',array(	'onclick' => 'jQuery(this).parents("form:first").submit()', 
    'class' => 'btn btn-primary' ))  !!}
</div>