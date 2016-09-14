<?php
if (!isset($attributes) || true) {
    $attributes['class'] =  'form-control';
    $attributes ['data-provide']= 'datepicker-inline';
    $attributes ['data-date-format']= 'd-m-yyyy';
}
?>
<div class="input-field date col-md-12 {{ $errors->has($key) ? ' has-error' : '' }}">
    {!! Form::label($key, $label) !!}

    @if(!$isDefaultWebsite)
        <div class="input-group">

            <?php
            $attributes['disabled'] = true;
            ?>
                {!! Form::text($key,NULL,$attributes) !!}
            <div class="input-group-addon">
                Same as Default {!! Form::checkbox('same_as_default' . $key, 'value', true, ['class' => 'same_as_default']) !!}
            </div>
        </div>
    @else
        {!! Form::text($key,NULL,$attributes) !!}
    @endif

    @if ($errors->has($key))
    <span class="help-block">
        <strong>{{ $errors->first($key) }}</strong>
    </span>
    @endif
</div>
