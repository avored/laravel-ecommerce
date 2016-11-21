{!! Form::open(['action' => route('review.store'), 'method' => 'post']) !!}

    <div class="form-group {{ $errors->has('star') ? ' has-error' : '' }}">
        <p>Please Select Rating</p>

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

    @if(!Auth::check())
  
     {!! Form::text('first_name','First Name') !!}
     {!! Form::text('last_name','Last Name') !!}
     {!! Form::text('email','Email') !!}
    @endif
    
    {!! Form::textarea('comment',"Comment") !!}
    <input type="hidden" name="product_id" value="{{ $product->id }}" />

    {!! Form::submit('Create Review') !!}
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