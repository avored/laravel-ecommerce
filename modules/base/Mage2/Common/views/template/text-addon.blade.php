<div class="input-field col-md-12 {{ $errors->has($key) ? ' has-error' : '' }}">
    {!! Form::label($key, $label) !!}

    <div class="input-group">
        @if(isset($prefix))
        <div class="input-group-addon">{{ $prefix }}</div>
        @endif

        {!! Form::text($key,NULL,['class' => 'form-control']) !!}

        @if(isset($postfix))
            <div class="input-group-addon">{{ $postfix }}</div>
        @endif

    </div>
    @if ($errors->has($key))
        <span class="help-block">
                <strong>{{ $errors->first($key) }}</strong>
            </span>
    @endif
</div>