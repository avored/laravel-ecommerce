<?php
if (!isset($attributes)) {
    //$attributes = ['class' => 'form-control select2'];
    $attributes['multiple'] = true;
}
?>
<div class="input-field col s12 {{ $errors->has($key) ? ' has-error' : '' }}">
    {!! Form::label($key, $label) !!}

    {!! Form::select($key,$options,NULL,$attributes) !!}

    @if ($errors->has($key))
    <span class="help-block">
        <strong>{{ $errors->first($key) }}</strong>
    </span>
    @endif
</div>
<script>
    jQuery(document).ready(function () {
       
    });
</script>