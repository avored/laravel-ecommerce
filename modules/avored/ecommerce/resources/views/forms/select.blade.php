<?php
$value = old($name);
if (isset($model) && $model->$name) {
    $value = $model->$name;
}
$attributes['type'] = 'text';
$attributes['class'] = 'form-control';
$attributes['id'] = $name;
$attributes['name'] = $name;
$attributes['value'] = $value;
if (isset($attributes)) {
    $attributes = array_merge($attributes, $attributes);
}

$attrString = '';

foreach ($attributes as $attrKey => $attrValue) {
    $attrString .= "{$attrKey}=\"{$attrValue}\"";
}

?>


<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <select {!! $attrString !!}>
        @foreach($options as $val => $lab)
        <option
                @if($value == $val)
                        selected
                @endif
                value="{{ $val }}">{{ $lab }}</option>
        @endforeach
    </select>

</div>