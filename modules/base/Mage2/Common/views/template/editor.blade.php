@if(!isset($attributes))
    <?php $attributes = []; ?>
@endif
<div class="input-field editor  {{ $errors->has($key) ? ' has-error' : '' }}">
    {!! Form::label($key, $label) !!}
    {!! Form::textarea($key,NULL,$attributes) !!}
    @if ($errors->has($key))
        <span class="help-block">
                <strong>{{ $errors->first($key) }}</strong>
            </span>
    @endif
</div>
<style>
    .input-field.editor {
        margin-top: 2rem;
        margin-bottom: 2rem;;
    }
    .input-field.editor label {
        top: -2rem;
    }
    .input-field.editor label.active {
        font-size: 1rem;
        top: -0.4rem;
    }
</style>

<script>
    CKEDITOR.replace( '<?php echo $key ?>' );
</script>