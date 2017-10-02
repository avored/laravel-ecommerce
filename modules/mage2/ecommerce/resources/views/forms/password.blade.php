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
</div>
