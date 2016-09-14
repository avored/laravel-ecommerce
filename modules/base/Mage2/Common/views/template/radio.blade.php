<?php
if(!isset($attributes)) {
    $attributes = ['class' => 'form-control'];
}
?>
<div class="input-field col-md-12 {{ $errors->has($key) ? ' has-error' : '' }}">
    {!! Form::label($key, $label) !!}

    {!! Form::radio($key,NULL,$attributes) !!}

    @if ($errors->has($key))
        <span class="help-block">
                <strong>{{ $errors->first($key) }}</strong>
            </span>
    @endif
</div>