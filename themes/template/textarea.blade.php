<?php
if(!isset($attributes)) {
    $attributes = ['class' => 'form-control'];
}
?>
<div class="form-group col-md-12 {{ $errors->has($key) ? ' has-error' : '' }}">
    {!! Form::label($key, $label) !!}

    {!! Form::textarea($key,NULL,['class' => 'form-control']) !!}

    @if ($errors->has($key))
        <span class="help-block">
                <strong>{{ $errors->first($key) }}</strong>
            </span>
    @endif
</div>