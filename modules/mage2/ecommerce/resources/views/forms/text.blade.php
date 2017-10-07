<?php

$value = "";
if(old($name)) {
    $value = old($name);
}  elseif(isset($model) && $model->$name) {
    $value = $model->$name;
}

if(isset($attributes)) {
    $attributes['name'] = $name;
    $attributes['type'] = "text";
    if(!isset($attributes['id'])) {
        $attributes['id'] = $name;
    }
    $attributes['value'] = $value;

} else {
    $attributes['type'] = "text";
    $attributes['class'] = 'form-control';
    $attributes['id'] = $name;
    $attributes['name'] = $name;
    $attributes['value'] = $value;

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
