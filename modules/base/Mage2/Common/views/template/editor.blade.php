<div class="input-field   {{ $errors->has($key) ? ' has-error' : '' }}">
    {!! Form::label($key, $label) !!}
    {!! Form::textarea($key,NULL,$attributes) !!}
    @if ($errors->has($key))
        <span class="help-block">
                <strong>{{ $errors->first($key) }}</strong>
            </span>
    @endif
</div>
<script>
    //    $('textarea').trigger('autoresize');


    CKEDITOR.replace( '<?php echo $key ?>' );

</script>