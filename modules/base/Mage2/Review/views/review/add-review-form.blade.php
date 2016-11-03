<form action="{{ route('review.store') }}" method="post">
    {{ csrf_field() }}

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
        <div class="form-group col s6  {{ $errors->has('first_name') ? ' has-error' : '' }}">

            <label for="first_name">First Name</label>
            <input type="text" name="first_name" class="form-control" id="first_name" value="" />
            @if ($errors->has('first_name'))
                <p>
                <span class="help-block">
                    <strong>{{ $errors->first('first_name') }}</strong>
                </span>
                </p>
            @endif
        </div>
        <div class="form-group col s6  {{ $errors->has('last_name') ? ' has-error' : '' }}">

            <label for="last_name">Last Name</label>
            <input type="text" name="last_name" class="form-control" id="last_name" value="" />
            @if ($errors->has('last_name'))
                <p>
                <span class="help-block">
                    <strong>{{ $errors->first('last_name') }}</strong>
                </span>
                </p>
            @endif
        </div>
        <div class="form-group col s12  {{ $errors->has('email') ? ' has-error' : '' }}">

            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control" value="" />
            @if ($errors->has('email'))
                <p>
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                </p>
            @endif
        </div>
        <div class="clearfix"></div>


    @endif


    <div class="form-group   {{ $errors->has('comment') ? ' has-error' : '' }}">
        
        
        {!! Form::textarea('comment',"Comment") !!}
        @if ($errors->has('comment'))
            <p>
            <span class="help-block">
                <strong>{{ $errors->first('comment') }}</strong>
            </span>
            </p>
        @endif
    </div>

    <input type="hidden" name="product_id" value="{{ $product->id }}" />


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