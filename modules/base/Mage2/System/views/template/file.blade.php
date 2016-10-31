<?php
if (!isset($attributes)) {
    $attributes = ['class' => 'form-control'];
}
?>

<div class="input-field file-field {{ $errors->has($key) ? ' has-error' : '' }}">

    <div class="btn">
        <span> {!! $label !!}</span>
        @if(!$isDefaultWebsite)

        <?php
        $attributes['disabled'] = true;
        ?>
        {!! Form::file($key,NULL,$attributes) !!}
        <div class="input-group-addon">
            Same as Default {!! Form::checkbox('same_as_default' . $key, 'value', true, ['class' => 'same_as_default']) !!}
        </div>
        @else
        {!! Form::file($key,NULL,$attributes) !!}
        @endif
    </div>
    <div class="file-path-wrapper">
        <input class="file-path validate" type="text">
    </div>

    @if ($errors->has($key))
    <span class="help-block">
        <strong>{{ $errors->first($key) }}</strong>
    </span>
    @endif
</div>