
{!! Form::text('first_name','First Name') !!}
{!! Form::text('last_name','Last Name') !!}

@if($editMethod == true) 
    <?php $attributes = ['disabled' => true];?>
@else
    <?php $attributes = []; ?>
@endif
{!! Form::text('email','Email',$attributes) !!}

{!! Form::password('password','Password') !!}
{!! Form::password('password_confirmation','Confirm Password') !!}

