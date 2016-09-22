<form action="" method="post">
    {{ csrf_field() }}

    <div class="input-field {{ $errors->has('star') ? ' has-error' : '' }}">
        <p>Please Select Star</p>

        <div id="rateYo"></div>
        <input type="hidden" name="star" id="product-page-create-review" value=""/>
        @if ($errors->has('star'))
            <p>
                <span class="help-block">
                    <strong>{{ $errors->first('star') }}</strong>
                </span>
            </p>
        @endif

    </div>
    <div class="input-field   {{ $errors->has('content') ? ' has-error' : '' }}">
        {!! Form::label('content', "Content") !!}
        {!! Form::textarea('content',NULL,['class' => 'materialize-textarea']) !!}
        @if ($errors->has('content'))
            <p>
            <span class="help-block">
                <strong>{{ $errors->first('content') }}</strong>
            </span>
            </p>
        @endif
    </div>



    @include('template.submit',['label' => 'Create Review'])
    <script>
        $(document).ready(function () {
            $("#rateYo").rateYo({

                onSet: function (rating, rateYoInstance) {
                    $("#product-page-create-review").val(rating);
                }
            });
        });
    </script>
</form>