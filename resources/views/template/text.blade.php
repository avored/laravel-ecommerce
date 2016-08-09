<?php
if(!isset($attributes)) {
    $attributes['class'] = 'form-control';
}
?>
<div class="form-group col-md-12 {{ $errors->has($key) ? ' has-error' : '' }}">
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
<script>
jQuery(document).ready(function() {
    jQuery(document).on('change','.same_as_default',function(e) {
        if(jQuery(this).is(':checked')) {
            jQuery(this).parents('.input-group:first').find('input[type="text"]').attr('disabled',true);
        } else {
            jQuery(this).parents('.input-group:first').find('input[type="text"]').attr('disabled',false);
        }
    })
});
</script>