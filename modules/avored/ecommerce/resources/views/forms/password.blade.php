<?php

if(isset($attributes)) {
    $attributes['name'] = $name;
    $attributes['type'] = "password";
    if(!isset($attributes['id'])) {
        $attributes['id'] = $name;
    }

} else {
    $attributes['type'] = "password";
    $attributes['class'] = 'form-control';
    $attributes['id'] = $name;
    $attributes['name'] = $name;

}


if($errors->has($name) && isset($attributes['class'])) {
    $attributes['class'] .= " is-invalid";
} elseif ($errors->has($name) && !isset($attributes['class'])){
    $attributes['class'] = "is-invalid";
}


$attrString = "";

foreach($attributes as $attrKey => $attrValue) {
    $attrString .= "{$attrKey}=\"{$attrValue}\"";
}

?>

<div class="form-group">
    @if(isset($label))
        <label for="{{ $name }}">{{ $label }}</label>
    @endif
    <input {!! $attrString !!} />

        @if($errors->has($name))
            <div class="invalid-feedback">
                {{ $errors->first($name) }}
            </div>
        @endif


</div>
