<div class="card card-default">
    <div class="card-content">
    <div class="card-title">
        <span>Extra</span>

        <!--div class="box-tools right">
            <button class="btn btn-box-tool" data-widget="collapse"
                    data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
        </div-->
    </div>
        <div class="form-group col s12 {{ $errors->has('related_products') ? ' has-error' : '' }}">
            {!! Form::label('related_products', 'Related Products') !!}

            {!! Form::select('related_products[]',[],NULL,['class' => 'select2-related form-control']) !!}

            @if ($errors->has('related_products'))
                <span class="help-block">
                <strong>{{ $errors->first('related_products') }}</strong>
            </span>
            @endif
        </div>

    </div>

</div>
<script>

    jQuery(document).ready(function () {
        
    })
</script>