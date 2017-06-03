
{!! Form::text('title','Title',['autofocus'=>true,'class' => 'form-control']) !!}
{!! Form::text('code','Code') !!}
{!! Form::text('discount','Discount') !!}
{!! Form::text('start_date','Start Date') !!}
{!! Form::text('end_date','End Date') !!}
{!! Form::select('status','Status',['ENABLED' => 'Enabled','DISABLED' => 'Disabled']) !!}

